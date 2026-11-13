
<?php $__env->startSection('content-client'); ?>
<div class="clearfix"></div>
<div class="hom-slider">
    <div class="container">
        <div id="sequence">
            <div class="sequence-prev"><i class="fa fa-angle-left"></i></div>
            <div class="sequence-next"><i class="fa fa-angle-right"></i></div>
            <ul class="sequence-canvas">
                <li class="animate-in">
                    <div class="flat-caption caption2 formLeft delay400 text-center">
                        <h1>FLAT SHOP</h1>
                    </div>
                    <div class="flat-caption caption3 formLeft delay500 text-center">
                        <p>Chào mừng đến với shop thời trang của chúng tôi - nơi cung cấp các sản phẩm đa dạng và chất lượng cao. Đến với chúng tôi để tìm kiếm phong cách của bạn!</p>
                        <p>Phong cách của bạn là niềm đam mê của chúng tôi - Hãy để chúng tôi giúp bạn thể hiện nó</p>
                    </div>
                    <div class="flat-image formBottom delay200" data-duration="5" data-bottom="true"><img src="<?php echo e(asset('asset/client/images/slider-image-01.png')); ?>" alt=""></div>
                </li>
                <li>
                    <div class="flat-caption caption2 formLeft delay400 text-center">
                        <h1>FLAT SHOP</h1>
                    </div>
                    <div class="flat-caption caption3 formLeft delay500 text-center">
                        <p>Chào mừng đến với shop thời trang của chúng tôi - nơi cung cấp các sản phẩm đa dạng và chất lượng cao. Đến với chúng tôi để tìm kiếm phong cách của bạn!</p>
                        <p>Phong cách của bạn là niềm đam mê của chúng tôi - Hãy để chúng tôi giúp bạn thể hiện nó</p>
                    </div>
                    <div class="flat-image formBottom delay200" data-bottom="true"><img src="<?php echo e(asset('asset/client/images/slider-image-03.png')); ?>" alt=""></div>
                </li>
            </ul>
        </div>
    </div>
    
</div>
<div class="clearfix"></div>
<div class="container_fullwidth">
    <div class="container">
        <div class="hot-products">
            <h3 class="title">Sản Phẩm Bán Chạy</h3>
            <div class="control"></div>
            <ul>
                <li>
                <div class="row">
                    <?php $__currentLoopData = $bellingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bellingProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="products">
                            <div class="offer">Bán Chạy</div>
                            <div class="thumbnail">
                                <a href="<?php echo e(route('user.products_detail', $bellingProduct->id)); ?>"><img src="<?php echo e(asset("asset/client/images/products/small/$bellingProduct->img")); ?>" alt="Product Name"></a>
                            </div>
                            <div class="productname" style="height: 42px;"><?php echo e($bellingProduct->name); ?></div>
                            <h4 class="price"><?php echo e(format_number_to_money($bellingProduct->price_sell)); ?> VNĐ</h4>
                            <div class="productname" style="padding-bottom: 10px; padding-top: unset;">
                                <?php if (isset($component)) { $__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e = $component; } ?>
<?php $component = App\View\Components\AvgStars::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('avg-stars'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AvgStars::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['number' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bellingProduct->avg_rating)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e)): ?>
<?php $component = $__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e; ?>
<?php unset($__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e); ?>
<?php endif; ?>
                                <span style="font-size: 14px;">Đã bán: <?php echo e($bellingProduct->sum); ?></span>
                            </div>
                            <div class="button_group"><a href="<?php echo e(route('user.products_detail', $bellingProduct->id)); ?>" class="button add-cart" type="button">Xem Chi Tiết</a></div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="featured-products">
            <h3 class="title">Sản Phẩm Mới Nhất</h3>
            <div class="control"></div>
            <ul>
                <li>
                <div class="row">
                    <?php $__currentLoopData = $newProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="products">
                                <div class="offer">Mới Nhất</div>
                                <div class="thumbnail"><a href="<?php echo e(route('user.products_detail', $newProduct->id)); ?>"><img src="<?php echo e(asset("asset/client/images/products/small/$newProduct->img")); ?>" alt="Product Name"></a></div>
                                <div class="productname" style="height: 42px;"><?php echo e($newProduct->name); ?></div>
                                <h4 class="price"><?php echo e(format_number_to_money($newProduct->price_sell)); ?> VNĐ</h4>
                                <div class="productname" style="padding-bottom: 10px; padding-top: unset;">
                                    <?php if (isset($component)) { $__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e = $component; } ?>
<?php $component = App\View\Components\AvgStars::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('avg-stars'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AvgStars::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['number' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($newProduct->avg_rating)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e)): ?>
<?php $component = $__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e; ?>
<?php unset($__componentOriginald3b5d9a1c9203d2bcf34c258aa56fed300a60d2e); ?>
<?php endif; ?>
                                    <span style="font-size: 14px;">Đã bán: <?php echo e($newProduct->sum); ?></span>
                                </div>
                                <div class="button_group"><a href="<?php echo e(route('user.products_detail', $newProduct->id)); ?>" class="button add-cart" type="button">Xem Chi Tiết</a></div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project\resources\views/client/index.blade.php ENDPATH**/ ?>