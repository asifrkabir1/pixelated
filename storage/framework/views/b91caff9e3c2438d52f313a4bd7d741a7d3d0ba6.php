

<?php $__env->startSection('content'); ?>

<main style="">
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-light">Edit</h1>
        <ol class="breadcrumb mb-4" style="background-color: #212529;">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active text-light">Edit</li>
        </ol>

        <form action="<?php echo e(route('admin.update', $portfolio->id)); ?>" method="POST" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>

            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="row text-light">
                    <div class="form-group col-md-6 mt-3">
                        <h3>Image</h3>
                        
                        <input class="mt-3" type="file" name="image" disabled>
                    </div>
    
                    <div class="form-group col-md-6 mt-3">
                        <div class="mb-3">
                            <label for="title">
                                <h4>Title</h4>
                            </label>
                            <input type="text" class="form-control" id="title" name="title" placeholder=""
                                value="<?php echo e($portfolio->title); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="author">
                                <h4>Author</h4>
                            </label>
                            <input type="text" class="form-control" id="client" name="client" placeholder=""
                                value="<?php echo e($portfolio->author); ?>" disabled>
                        </div>
                        <div class="mb-5">
                            <label for="category">
                                <h4>Category</h4>
                            </label>
                            <input type="text" class="form-control" id="category" name="category" placeholder=""
                                value="<?php echo e($portfolio->category); ?>">
                        </div>
                    </div>
    
                    <div class="form-group col-md-12 mt-3">
                        <h3>Description</h3>
                        <textarea class="form-control" name="description" rows="5"><?php echo e($portfolio->description); ?></textarea>
                    </div>
                    <input style="max-width: 20%;" type="submit" name="submit" value="Update" class="btn btn-primary my-5 mx-auto rounded-pill">
                </div>
            </div>
        </form>
    </div>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Courses\Laravel\LaravelProject\pixelated\resources\views/pages/admin/edit.blade.php ENDPATH**/ ?>