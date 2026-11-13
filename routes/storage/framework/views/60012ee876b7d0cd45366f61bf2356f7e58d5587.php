
<?php $__env->startSection('content-client'); ?>
<div class="container_fullwidth" style="min-height: calc(100vh - 389px);">
    <div class="container">
        <div class="hot-products">
            <h3 class="title">
                <?php if(count($products) > 0): ?>
                    Kết quả tìm kiếm cho từ khoá '<span style="color:#f7544a;"><?php echo e($contentSearch); ?></span>'
                <?php else: ?>
                    Chúng tôi không tìm thấy sản phẩm '<span style="color:#f7544a;"><?php echo e($contentSearch); ?></span>' nào       
                <?php endif; ?>
            </h3>
            <form class="row" method="GET">
                <input type="text" value="<?php echo e($contentSearch); ?>" hidden name="keyword">
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control form-select" name="category">
                            <option disabled selected>Chọn danh mục</option>
                            <option value="" >Tất cả</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" ><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control form-select" name="brand">
                            <option disabled selected>Chọn thương hiệu</option>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e(($item->id == $brand) ? 'selected' : ''); ?>><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" style="display: flex; align-items: center;">
                        <input type="text" class="form-control price-filter" value="<?php echo e($minPrice); ?>" placeholder="Giá từ" name="min_price">
                        <span style="border-top: 1px; width: 50px;"></span>
                        <input type="text" class="form-control price-filter" value="<?php echo e($maxPrice); ?>" placeholder="Giá đến" name="max_price">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <button class="price-filter">Lọc tìm kiếm</button>
                    </div>
                </div>
            </form>
            <ul>
                <li>
                <div class="row">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="products">
                                <div class="thumbnail">
                                    <a href="<?php echo e(route('user.products_detail', $product->id)); ?>"><img src="<?php echo e(asset("asset/client/images/products/small/$product->img")); ?>" alt="Product Name"></a>
                                </div>
                                <div class="productname" style="height: 42px;"><?php echo e($product->name); ?></div>
                                <h4 class="price"><?php echo e(format_number_to_money($product->price_sell)); ?> VNĐ</h4>
                                <div class="productname" style="padding-bottom: 10px; padding-top: unset;">
                                    <?php if (isset($component)) { $__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e = $component; } ?>
<?php $component = App\View\Components\AvgStars::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('avg-stars'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AvgStars::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['number' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->avg_rating)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e)): ?>
<?php $component = $__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e; ?>
<?php unset($__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e); ?>
<?php endif; ?>
                                    <span style="font-size: 14px;">Đã bán: <?php echo e($product->sum); ?></span>
                                </div>
                                <div class="button_group">
                                    <a href="<?php echo e(route('user.products_detail', $product->id)); ?>" class="button add-cart" type="button">Xem Chi Tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                </li>
            </ul>
        </div>
        <div class="text-center">
            <ul class="pagination">
                <?php echo e($products->links('vendor.pagination.default')); ?>

            </ul>
        </div>
    </div>
</div>
<?php echo app('Illuminate\Foundation\Vite')(['resources/client/css/search.css']); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project\resources\views/client/search.blade.php ENDPATH**/ ?>