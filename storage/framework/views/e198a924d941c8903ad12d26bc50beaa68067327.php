

<?php if(Auth::user()->role == 0): ?>
    
    <?php $__env->startSection('content'); ?>

        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">List of Images</h1>
                <ol class="breadcrumb mb-4" style="background-color: #212529;">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active text-light">List of Images</li>
                </ol>

                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Author</th>
                            <th scope="col">Likes</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($portfolios) > 0): ?>
                            <?php $__currentLoopData = $portfolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portfolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($portfolio->author == Auth::user()->name): ?>
                                    <tr>
                                        <th scope="row"><?php echo e($portfolio->id); ?></th>
                                        <td><?php echo e($portfolio->title); ?></td>
                                        <td><?php echo e(Str::limit(strip_tags($portfolio->description), 40)); ?></td>
                                        <td>
                                            <img style="height: 10vh" src="<?php echo e(url($portfolio->image)); ?>" alt="image">
                                        </td>
                                        <td><?php echo e($portfolio->author); ?></td>
                                        <td><?php echo e($portfolio->likes); ?></td>
                                        <td><?php echo e($portfolio->category); ?></td>
                                        <td>
                                            <div class="row">
                                                <div>
                                                    <a href="<?php echo e(route('user.portfolios.edit', $portfolio->id)); ?>"
                                                        class="btn btn-primary m-2">Edit</a>
                                                </div>
                                                <div>
                                                    <form action="<?php echo e(route('user.portfolios.destroy', $portfolio->id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <input type="submit" name="submit" value="Delete" class="btn btn-danger m-2">
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>

    <?php $__env->stopSection(); ?>

<?php else: ?>
    
    <?php $__env->startSection('content'); ?>

    <main>
        <div class="container-fluid d-flex justify-content-center align-items-center">
            
            <h1 class="text-center text-light fw-bold">YOU CANNOT ACCESS THIS PAGE</h1>

        </div>
    </main>

    <?php $__env->stopSection(); ?>

<?php endif; ?>
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Courses\Laravel\LaravelProject\pixelated\resources\views/pages/portfolios/list.blade.php ENDPATH**/ ?>