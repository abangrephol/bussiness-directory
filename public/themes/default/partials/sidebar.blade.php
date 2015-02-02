<div class="" id="categories">
    <div class="accordion">
        <ul class="nav nav-tabs home-tab" role="tablist">
            <li class="active">
                <a href="#all" role="tab" data-toggle="tab">
                    All Categories<span>Display All Sub-Category</span>
                </a>
            </li>
            @foreach (Category::withDepth()->having('depth', '=', 0)->get() as $category)
                <li class="">
                    <a href="#{{ $category->slug }}" role="tab" data-toggle="tab">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>