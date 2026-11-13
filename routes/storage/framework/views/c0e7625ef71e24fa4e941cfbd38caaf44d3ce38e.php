
<?php $__env->startSection('content-client'); ?>
<style>
   
    .separate {
        float: left;
        margin: 0 5px 0 5px;
        font-size: 24px;
        font-weight: 700;
        color: #bfbfbf;
    }
    .checkboxx {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border: 1px solid #ccc;
        border-radius: 0;
        width: 14px;
        height: 14px;
        outline: none;
        cursor: pointer;
    }

    .checkboxx:checked::before {
    content: "\2713";
    display: inline-block;
    text-align: center;
    font-size: 12px;
    width: 14px;
    height: 14px;
    line-height: 14px;
    color: #fff;
    background-color: #007bff;
    border: 2px solid #007bff;
    }

    .name-filter{
        display: inline !important;
        margin-top: 1px;
    }

    .checkboxx:focus{
        outline: none !important;
        outline: none !important;
        outline-offset: unset !important;
    }
</style>
<div class="container_fullwidth">
    <div class="container">
        <div class="row">
            <form method="get">
                <div class="col-md-3">
                    <div class="category leftbar">
                    <h3 class="title">
                        Danh Mục Sản Phẩm
                    </h3>
                    <ul>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <input type="radio" class="checkboxx" value="<?php echo e($category->slug); ?>" <?php echo e(($categorySlug == $category->slug) ? 'checked' : ''); ?> name="category_slug">
                                <a class="name-filter">
                                    <?php echo e($category->name); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    </div>
                    <div class="clearfix">
                    </div>
                    <div class="branch leftbar">
                        <h3 class="title">
                            Thương hiệu
                        </h3>
                        <ul>
                            <li>
                                <input type="radio" class="checkboxx" value="" name="brand_id" <?php echo e(($request->brand_id == '') ? 'checked' : ''); ?>>
                                <a class="name-filter">
                                    Tất cả
                                </a>
                            </li>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <input type="radio" class="checkboxx" value="<?php echo e($brand->id); ?>" <?php echo e(($request->brand_id == $brand->id) ? 'checked' : ''); ?> name="brand_id">
                                    <a class="name-filter">
                                        <?php echo e($brand->name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="clearfix">
                    </div>
                    <div class="price-filter leftbar" style="width:100%;">
                        <h3 class="title">
                            Khoảng Giá
                        </h3>
                        <div style="display: flex; width: 100%;">
                            <input id="min-price" type="text" value="<?php echo e($request->min_price ?? ''); ?>" class="form-control price-filter" placeholder="Giá từ" name="min_price">
                            <span class="separate">-</span>
                            <input id="max-price" type="text" value="<?php echo e($request->max_price ?? ''); ?>" class="form-control price-filter" placeholder="Giá đến" name="max_price">
                        </div>
                    </div>
                    <div style="display: flex; width: 100%; margin-top: 10px; justify-content: center;">
                        <button id="filter-price" url="<?php echo e($request->fullUrl()); ?>">Lọc Sản Phẩm</button>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </form>
            <div class="col-md-9">
                <div class="products-grid">
                    <div class="row">
                        <?php if(count($products) > 0): ?>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="products">
                                        <div class="thumbnail">
                                            <a href="<?php echo e(route('user.products_detail', $product->id)); ?>">
                                                <img src="<?php echo e(asset("asset/client/images/products/small/$product->img")); ?>" alt="Product Name">
                                            </a>
                                        </div>
                                        <div class="productname" style="height: 42px;">
                                            <?php echo e($product->name); ?>

                                        </div>
                                        <h4 class="price">
                                            <?php echo e(format_number_to_money($product->price_sell)); ?>

                                        </h4>
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
                        <?php else: ?>
                        <h3 class="title" style="padding-top: 20px;">Không tìm thấy sản phẩm</h3>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
                <?php if(count($products) > 0): ?>
                <div class="text-center">
                    <ul class="pagination">
                        <?php echo e($products->links('vendor.pagination.default')); ?>

                    </ul>
                </div>
                <?php endif; ?>
            </div>
            <div class="clearfix">
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project\resources\views/client/show-product.blade.php ENDPATH**/ ?>