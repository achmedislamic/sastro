@if ($sortField !== $field)
    <span></span>
@elseif($sortAsc)
    <x-icon name="sort-descending" style="solid" class="w-5 h-5 dark:text-white text-black" />
@else
    <x-icon name="sort-ascending" style="solid" class="w-5 h-5 dark:text-white text-black" />
@endif
