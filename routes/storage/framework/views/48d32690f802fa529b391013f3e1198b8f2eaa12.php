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

<div style="display: inline;" class="start-container">
    <?php for($i = 1; $i <= 5; $i++): ?>
        <?php if($i <= floor($number)): ?>
            <i class="fas fa-star"></i>
        <?php else: ?>
            <?php if(strlen(rtrim($number, '0')) >= 3 && floor($number) + 1 == $i): ?>
                <i class="fas fa-star-half-alt"></i>
            <?php else: ?>
                <i class="fas fa-star none"></i>
            <?php endif; ?>
        <?php endif; ?>
    <?php endfor; ?>
</div>
<?php /**PATH C:\xampp\htdocs\Project\resources\views/components/avg-stars.blade.php ENDPATH**/ ?>