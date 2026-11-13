<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['number']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['number']); ?>
<?php foreach (array_filter((['number']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php for($i = 1; $i <= 5; $i++): ?>
    <?php if($i <= $number): ?>
        <i class="fas fa-star"></i>
    <?php else: ?>
        <i class="fas fa-star star-none"></i>
    <?php endif; ?>
<?php endfor; ?><?php /**PATH C:\xampp\htdocs\Project\resources\views/components/stars.blade.php ENDPATH**/ ?>