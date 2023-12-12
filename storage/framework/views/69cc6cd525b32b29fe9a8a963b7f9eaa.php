<section class="bg-gray-50 dark:bg-gray-900 mb-32">
    <div class="mx-auto">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-visible">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Search" required="">
                        </div>
                    </form>
                </div>
                
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Issue</th>
                            <th scope="col" class="px-4 py-3">Kategori</th>
                            <th scope="col" class="px-4 py-3">Tanggal</th>
                            <th scope="col" class="px-4 py-3">pelapor</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo e($item->excerpt); ?></th>
                            <td class="px-4 py-3"><?php echo e($item->kategori); ?></td>
                            <td class="px-4 py-3"><?php echo e($item->created_at); ?></td>
                            <td class="px-4 py-3"><?php echo e($item->users_id->username); ?></td>
                            <td class="px-4 py-3"><p class=" w-fit rounded-full text-xs capitalize
                                <?php switch($item->progres):
                                case ('draft'): ?>
                                    px-2 py-1 bg-yellow-200 text-yellow-800 border-yellow-300
                                    <?php break; ?>
                                <?php case ('on going'): ?>
                                    px-2 py-1 bg-green-200 text-green-800 border-green-300
                                    <?php break; ?>
                                <?php case ('done'): ?>
                                    px-2 py-1 bg-blue-200 text-blue-800 border-blue-300
                                    <?php break; ?>
                                <?php default: ?>
                                    px-2 py-1 bg-gray-200 text-gray-800 border-gray-300

                            <?php endswitch; ?>
                                "><?php echo e($item->progres); ?></p></td>
                            <td class="px-4 py-3 flex items-center justify-center text-blue-600">
                               <?php if(auth()->user()->can('ubah feedback')): ?>
                                <a href="/feedback_detail/?id=<?php echo e($item->id); ?>">
                                    Detail
                                </a>
                               <?php else: ?>
                                <a href="#">
                                    Detail
                                </a>
                               <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                aria-label="Table navigation">
                <?php echo e($data->links()); ?>

            </nav>
        </div>
    </div>
</section>
<?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/dashboard/admin/feedback/layouts/tabel_feedback.blade.php ENDPATH**/ ?>