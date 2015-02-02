<div class="" id="categories">
    <div class="accordion">
        <ul class="nav nav-tabs accordion-tab" role="tablist">
            <li class="active">
                <a href="#all" role="tab" data-toggle="tab">
                    All Categories<span>Display All Sub-Category</span>
                </a>
            </li>
            @foreach (Category::withDepth()->having('depth', '=', 0)->get() as $category)
            <li class="">
                <a href="#cat-{{ $category->id }}" role="tab" data-toggle="tab">
                    {{ $category->name }}
                </a>
                <div>
                    @foreach ($category->getDescendants() as $subcat)
                    <a href="#{{ $subcat->slug }}" role="tab" data-toggle="tab">{{ $subcat->name }}</a>
                    @endforeach
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>