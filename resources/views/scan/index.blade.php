<style>
    /* Styling agar UI bawaan library nyatu sama tema Dark Mode lu */
    #reader {
        border: none !important;
    }
    #reader __dashboard_section_csr {
        padding: 10px;
    }
    /* Tombol Start/Stop/File */
    #reader button {
        background-color: #6366f1 !important; /* indigo-500 */
        color: white !important;
        padding: 10px 20px !important;
        border-radius: 12px !important;
        border: none !important;
        font-weight: 600 !important;
        margin: 10px 5px !important;
        cursor: pointer !important;
        transition: all 0.2s;
    }
    #reader button:hover {
        background-color: #4f46e5 !important;
        transform: translateY(-1px);
    }
    /* Select Camera */
    #reader select {
        background-color: #374151 !important;
        color: white !important;
        border: 1px solid #4b5563 !important;
        border-radius: 8px !important;
        padding: 5px !important;
    }
    #reader a {
        color: #818cf8 !important;
        text-decoration: none !important;
    }
</style>

<x-app-layout>
    <div class="py-12 px-4">
        <div class="max-w-xl mx-auto">
            <div class="bg-gray-800 border border-gray-700 rounded-t-2xl p-6">
                <h1 class="text-2xl font-bold text-white flex items-center">
                    <span class="p-2 bg-indigo-500/20 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </span>
                    Scan / Upload QR Siswa
                </h1>
            </div>

            <div class="bg-gray-800 border-x border-gray-700 p-4">
                <div id="reader" class="rounded-xl overflow-hidden border-2 border-gray-600 bg-black shadow-inner"></div>
            </div>

            <div class="bg-gray-900 border border-gray-700 rounded-b-2xl p-6 shadow-xl text-center">
                <div id="result-container" class="min-h-[80px] flex flex-col items-center justify-center">
                    <div id="loading-spinner" class="hidden mb-2">
                        <svg class="animate-spin h-8 w-8 text-indigo-500" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <p id="result-text" class="text-gray-400 font-medium">Gunakan Kamera atau Upload Foto QR</p>
                </div>
                <button onclick="location.reload()" class="mt-4 text-xs text-gray-500 hover:text-white uppercase tracking-widest transition">
                    Refresh Scanner
                </button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        const resultText = document.getElementById('result-text');
        const loader = document.getElementById('loading-spinner');
        let isProcessing = false;

        function onScanSuccess(decodedText, decodedResult) {
            if (isProcessing) return;

            isProcessing = true;
            
            // Suara Bip biar makin legit
            new Audio('https://assets.mixkit.co/active_storage/sfx/2216/2216-preview.mp3').play();

            loader.classList.remove('hidden');
            resultText.innerText = "Memverifikasi...";
            resultText.className = "text-indigo-400 font-bold";

            // Pastikan route ini sesuai dengan di web.php (tadi kita pakai scan.store)
            fetch("{{ route('scan.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ qr_code: decodedText })
            })
            .then(res => res.json())
            .then(data => {
                loader.classList.add('hidden');
                // Mengikuti struktur AttendanceController yang kita buat tadi
                showResponse(data.message, 'text-green-400');
            })
            .catch(err => {
                loader.classList.add('hidden');
                showResponse("Siswa Tidak Terdaftar / Error!", 'text-red-500');
            })
            .finally(() => {
                setTimeout(() => {
                    isProcessing = false;
                    resultText.innerText = "Siap scan selanjutnya...";
                    resultText.className = "text-gray-400 font-medium";
                }, 4000); // Jeda 4 detik biar user bisa baca statusnya
            });
        }

        function showResponse(msg, colorClass) {
            resultText.innerText = msg;
            resultText.className = `${colorClass} font-bold text-xl animate-pulse`;
        }

        // Fungsi hitung lebar kotak scanner biar gak zoom-zoom amat
        let qrboxFunction = function(viewfinderWidth, viewfinderHeight) {
            let minEdgePercentage = 0.7; // 70%
            let minEdgeSize = Math.min(viewfinderWidth, viewfinderHeight);
            let qrboxSize = Math.floor(minEdgeSize * minEdgePercentage);
            return {
                width: qrboxSize,
                height: qrboxSize
            };
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 20, 
                qrbox: qrboxFunction,
                aspectRatio: 1.777778, // Pakai 16:9 biar wide, gak nge-zoom parah kayak 1:1
                rememberLastUsedCamera: true,
                supportedScanTypes: [
                    Html5QrcodeScanType.SCAN_TYPE_CAMERA, 
                    Html5QrcodeScanType.SCAN_TYPE_FILE 
                ]
            }
        );

        html5QrcodeScanner.render(onScanSuccess);
    </script>
</x-app-layout>