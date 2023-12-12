<section class="bg-white rounded-md shadow-md shad dark:bg-gray-900 mb-28">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Kirim Feedback Ke Kami</h2>
        <form action="/feedback" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Feedback</label>
                    <select name="kategori" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Select Kategori</option>
                        <option value="Error Found">Error Found</option>
                        <option value="Improvement">Improvement</option>
                        <option value="Tambah Fitur Baru">Tambah Fitur Baru</option>
                    </select>
                </div>
                
                <div class="sm:col-span-2">
                    <input id="deskripsi" value="Dear Tim IT" type="hidden" name="deskripsi">
                    <trix-editor name="deskripsi" input="deskripsi"></trix-editor>
                </div>
                <div class="sm:col-span-2">
                    <label for="info_tambahan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Info Tambahan</label>
                    <input type="text" name="info_tambahan" id="info_tambahan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                </div>
                <div>
                    <img id="image-review" class="w-42 h-42 hidden" src="" alt="">
                    <button type="button" id="btn-delete-preview" class="text-xs px-2 py-1 mt-3 font-medium bg-red-600 text-white w-fit rounded-md hidden">Hapus</button>
                </div>
                <div class="sm:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Lampiran (optional)</label>
                    <input id="lampiran" name="lampiran" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG.</p>
                </div>
            </div>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Kirim Feedback
            </button>
        </form>
    </div>
  </section>

  <script>
    const lampiran = document.getElementById('lampiran')
    const imageReview = document.getElementById('image-review')
    const btnDeletePreview = document.getElementById('btn-delete-preview')
    const newLampiran = lampiran.cloneNode(true)

    lampiran.addEventListener('change', function() {
        const file = lampiran.files[0]; // Mengambil file dari input
            if (file) {
            const imageUrl = URL.createObjectURL(file); // Membuat URL objek dari file
            imageReview.src = imageUrl; // Menampilkan gambar dalam elemen img
            imageReview.classList.remove('hidden')
            // btnDeletePreview.classList.remove('hidden')
            }
    })


    // btnDeletePreview.addEventListener('click', function() {
    //     imageReview.src = ''
    //     imageReview.classList.add('hidden')
    //     btnDeletePreview.classList.add('hidden')
    //     lampiran.parentNode.replaceChild(newLampiran, lampiran)
    // })

  </script>
<?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/dashboard/feedback/layouts/form_feedback.blade.php ENDPATH**/ ?>