@extends('user.layouts.main_layouts')

@section('container')
    <section class="bg-50 h-screen w-screen flex justify-center items-center">
        <div class="px-7 py-7 rounded-md shadow-md flex flex-col items-center justify-center">
            <a href="#" class="flex items-center mb-2 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="h-20 mr-2"
                    src="https://res.cloudinary.com/du0tz73ma/image/upload/v1702445620/octansidnByBoxity_vwv8wi.png"
                    alt="OctansIDN Logo Official">
            </a>
            <div class="w-80">
                <div class="text-center text-red-600 font-semibold text-xl mb-3" id="countdown"></div>
                <p class="mb-3 class text-gray-700">Transfer ke virtual account</p>
                <p class="mb-2 uppercase">{{ $sender_bank }}</p>
                <div class="bg-gray-200 px-5 py-3 rounded-md">
                    <p class="text-gray-600 font-semibold">{{ $noVa }}</p>
                </div>
                <p class="my-3">Nominal Transafer</p>
                <div class="bg-gray-200 px-5 py-3 rounded-md">
                    <p class="text-gray-600 font-semibold">Rp {{ number_format($amount, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        function checkPaymentStatus() {
            fetch('/check-payment-status')  // Endpoint untuk memeriksa status pembayaran
                .then(response => response.text())
                .then(data => {
                    if (data == 'successful') {
                        window.location.href = '/';  // Redirect ke dashboard jika pembayaran berhasil
                    } else {
                        setTimeout(checkPaymentStatus, 5000);  // Cek lagi setelah 5 detik
                    }
                })
                .catch(error => {
                    console.error('Error checking payment status:', error);
                    setTimeout(checkPaymentStatus, 5000);  // Cek lagi setelah 5 detik setelah kesalahan
                });
        }

        // Panggil fungsi pertama kali
        checkPaymentStatus();

        document.addEventListener('DOMContentLoaded', function () {
            const countdownElement = document.getElementById('countdown');
            let countdownDuration = 600; // Durasi countdown dalam detik (10 menit)

            function updateCountdown() {
                const minutes = Math.floor(countdownDuration / 60);
                const seconds = countdownDuration % 60;

                countdownElement.innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

                if (countdownDuration > 0) {
                    countdownDuration--;
                } else {
                    clearInterval(countdownInterval);
                    countdownElement.innerText = 'Waktu Habis!';
                    window.location.href = '/chose-payment-methode';
                }
            }

            // Pertama kali panggil fungsi updateCountdown
            updateCountdown();

            // Selanjutnya, update countdown setiap detik
            const countdownInterval = setInterval(updateCountdown, 1000);
        });



    </script>
@endsection
