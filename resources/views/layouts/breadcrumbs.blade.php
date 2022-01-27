@unless ($breadcrumbs->isEmpty())

    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                @if($breadcrumb->url != '')
                    <li class=""><a href="{{ $breadcrumb->url }}"><i class="{{ $breadcrumb->icon }}"></i> {{ $breadcrumb->title }}</a></li>
                @else
                    <li class=""><i class="{{ $breadcrumb->icon }}"></i> {{ $breadcrumb->title }}</li>
                @endif            
            @else
                <li class="active"><i class="{{ $breadcrumb->icon }}"></i> {{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>

@endunless