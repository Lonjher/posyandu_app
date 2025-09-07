<?php

namespace App\Livewire;

use App\Models\AnakPemeriksaan;
use App\Models\BumilPemeriksaan;
use App\Models\Edukasi;
use App\Models\LansiaPemeriksaan;
use GuzzleHttp\Client;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $bumilCount, $anakCount, $lansiaCount, $totalWarga;
    public $recentPemeriksaan;
    public $giziBaik, $giziSedang, $giziBuruk;
    public $jadwalHariIni;
    public $bumilCheckedToday, $anakCheckedToday, $lansiaCheckedToday;
    public $lastPemeriksaan, $statusKesehatan, $rekomendasi;
    public $monthlyLabels = [];
    public $monthlyBumil = [];
    public $monthlyAnak = [];
    public $monthlyLansia = [];

    public $anakLabels = [];
    public $bb = [];
    public $tb = [];

    public function mount()
    {
        $this->loadData();
    }

    protected function loadData()
    {
        // Siapkan 6 bulan terakhir
        $months = collect(range(5, 0))->map(fn($i) => Carbon::now()->subMonths($i));
        $this->monthlyLabels = $months->map(fn($m) => $m->format('M Y'))->toArray();

        if (Auth::user()->kategori === 'anak') {
            $this->dataAnak();
        } elseif (Auth::user()->kategori === 'lansia') {
            $this->dataLansia();
        } else {
            $this->dataBumil();
        }

        foreach ($months as $month) {
            $this->monthlyBumil[] = BumilPemeriksaan::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)->count();

            $this->monthlyAnak[] = AnakPemeriksaan::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)->count();

            $this->monthlyLansia[] = LansiaPemeriksaan::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)->count();
        }
        // Jumlah warga berdasarkan kategori
        $this->bumilCount = User::where('kategori', 'bumil')->count();
        $this->anakCount = User::where('kategori', 'anak')->count();
        $this->lansiaCount = User::where('kategori', 'lansia')->count();
        $this->totalWarga = $this->bumilCount + $this->anakCount + $this->lansiaCount;

        // Pemeriksaan terbaru (ambil 5 terakhir dari gabungan semua)
        $this->recentPemeriksaan = collect()
            ->merge(BumilPemeriksaan::with('user')->latest()->take(5)->get())
            ->merge(AnakPemeriksaan::with('user')->latest()->take(5)->get())
            ->merge(LansiaPemeriksaan::with('user')->latest()->take(5)->get())
            ->sortByDesc('created_at')
            ->take(5);

        // Jadwal pemeriksaan hari ini
        // $this->jadwalHariIni = Jadwal::with('user')
        //     ->whereDate('tanggal', Carbon::today())
        //     ->get();

        // Pemeriksaan yang dilakukan hari ini
        $this->bumilCheckedToday = BumilPemeriksaan::whereDate('created_at', Carbon::today())->count();
        $this->anakCheckedToday = AnakPemeriksaan::whereDate('created_at', Carbon::today())->count();
        $this->lansiaCheckedToday = LansiaPemeriksaan::whereDate('created_at', Carbon::today())->count();

        // Status gizi hanya untuk anak
        $this->giziBaik = AnakPemeriksaan::where('kesimpulan_hasil_pengukuran_bb', 'Gizi Baik')->count();
        $this->giziSedang = AnakPemeriksaan::where('kesimpulan_hasil_pengukuran_bb', 'Gizi Kurang')->count();
        $this->giziBuruk = AnakPemeriksaan::where('kesimpulan_hasil_pengukuran_bb', 'Gizi Buruk')->count();

        // Untuk user (jika login sebagai user)
        if (Auth::user()->role) {
            $kategori = Auth::user()->kategori;
            $userId = Auth::id();

            switch ($kategori) {
                case 'bumil':
                    $this->lastPemeriksaan = BumilPemeriksaan::where('bumil_id', $userId)
                        ->latest()->first();
                    break;

                case 'anak':
                    $this->lastPemeriksaan = AnakPemeriksaan::where('anak_id', $userId)
                        ->latest()->first();
                    break;

                case 'lansia':
                    $this->lastPemeriksaan = LansiaPemeriksaan::where('lansia_id', $userId)
                        ->latest()->first();
                    break;

                default:
                    $this->lastPemeriksaan = null;
            }

            $this->statusKesehatan = $this->determineStatusKesehatan(Auth::user());
            $this->rekomendasi = $this->generateRekomendasi($this->statusKesehatan);
        }
    }

    protected function dataAnak()
    {
        // Ambil semua pemeriksaan anak milik user yang login
        $user = Auth::user();
        // dd($user->pemeriksaanAnaks);
        $anakPemeriksaans = $user->pemeriksaanAnaks;


        foreach ($anakPemeriksaans as $item) {
            $this->anakLabels[] = Carbon::parse($item->created_at)->format('M Y');
            $this->bb[] = (float) $item->bb;
            $this->tb[] = (float) $item->tb;
        }
    }

    protected function dataLansia()
    {
        // Ambil semua pemeriksaan anak milik user yang login
        $user = Auth::user();
        // dd($user->pemeriksaanAnaks);
        $lansiaPemeriksaans = $user->pemeriksaanLansias;


        foreach ($lansiaPemeriksaans as $item) {
            $this->anakLabels[] = Carbon::parse($item->created_at)->format('M Y');
            $this->bb[] = (float) $item->bb;
            $this->tb[] = (float) $item->tb;
        }
    }

    protected function dataBumil()
    {
        // Ambil semua pemeriksaan anak milik user yang login
        $user = Auth::user();
        // dd($user->pemeriksaanAnaks);
        $lansiaPemeriksaans = $user->pemeriksaanBumils;


        foreach ($lansiaPemeriksaans as $item) {
            $this->anakLabels[] = Carbon::parse($item->created_at)->format('M Y');
            $this->bb[] = (float) $item->berat_badan;
            $this->tb[] = (float) $item->sistole_distole;
        }
    }

    protected function determineStatusKesehatan($user)
    {
        if ($user->kategori === 'bumil') {
            $pemeriksaans = $user->pemeriksaanBumils()
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get();

            if ($pemeriksaans->count() < 2)
                return 'Stabil';

            $current = $pemeriksaans[0];
            $previous = $pemeriksaans[1];

            if ($current->berat_badan > $previous->berat_badan) {
                return 'Meningkat';
            } elseif ($current->berat_badan < $previous->berat_badan) {
                return 'Menurun';
            } else {
                return 'Stabil';
            }
        }

        // Kategori anak
        if ($user->kategori === 'anak') {
            $pemeriksaans = $user->pemeriksaanAnaks()
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get();

            if ($pemeriksaans->count() < 2)
                return 'Stabil';

            $current = $pemeriksaans[0];
            $previous = $pemeriksaans[1];

            if ($current->bb > $previous->bb)
                return 'Meningkat';
            if ($current->bb < $previous->bb)
                return 'Menurun';
            return 'Stabil';
        }

        // Kategori lansia
        if ($user->kategori === 'lansia') {
            $pemeriksaans = $user->pemeriksaanLansias()
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get();

            if ($pemeriksaans->count() < 2)
                return 'Stabil';

            $current = $pemeriksaans[0];
            $previous = $pemeriksaans[1];

            if ($current->bb > $previous->bb)
                return 'Meningkat';
            if ($current->bb < $previous->bb)
                return 'Menurun';
            return 'Stabil';
        }
        return 'Stabil'; // Default fallback
    }


    protected function generateRekomendasi($status)
    {
        return match ($status) {
            'Meningkat' => 'Pertahankan gaya hidup sehat.',
            'Menurun' => 'Segera periksa ke petugas kesehatan.',
            default => 'Terus pantau kondisi secara berkala.',
        };
    }

    public function render()
    {
        $edukasis = Edukasi::latest()->paginate(3);
        $dataWeather = $this->getWeather();
        return view('livewire.dashboard', [
            'edukasis' => $edukasis,
            'dataWeather' => $dataWeather
        ]);
    }

    #[Computed]
    public function getWeather()
    {
        $apiKey = env('OPEN_WEATHER_API_KEY');

        $lat = -7.064076955499314; // latitude (Sidoarjo/Jawa Timur, contoh)
        $lon = 113.67471157180913; // longitude

        $apiUrl = "http://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$lat}, {$lon}&aqi=yes";

        try {
            $client = new Client();
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (\Exception $e) {
            // Log::error('Gagal mengambil data cuaca: ' . $e->getMessage());

            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Error',
                text: 'Gagal mengambil data cuaca: ' . $e->getMessage(),
                timer: 6000
            );

            return null;
        }
    }
}
