<div class="" id="categories">
    <div class="accordion">
        <ul class="nav nav-tabs home-tab" role="tablist">
            @foreach (Category::withDepth()->having('depth', '=', 0)->get() as $category)
                <li class="">
                    <a href="#cat-{{ $category->id }}" role="tab" data-toggle="tab">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>