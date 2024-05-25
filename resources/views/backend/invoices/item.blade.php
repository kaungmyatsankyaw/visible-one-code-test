@foreach ($items as $item)
    @if (!isset($add_item_list))
        <div class="row  p-3" style="background: white;border-bottom: 1px solid black">
        @else
            <div class="row  p-3" style="background: white;border-bottom: 1px solid black"
                id='add-item-list-{{ $item->id }}'>
    @endif

    <div class="col-1">
        <div class="form-check">
            @if (!isset($add_item_list))
                <input type="checkbox" class="item-add-check" value="{{ $item->id }}" onchange="addToItemList(this)">
            @endif
        </div>
    </div>
    <div class="col-1">
        {{ $item->item_description }}
    </div>
    <div class="col-1">
        {{ $item->kg }}
    </div>
    <div class="col-1">
        {{ $item->container_number }}
    </div>



    @if (!isset($add_item_list))
        <div class="col-1">
            <div class="input-group input-group-outline  w-100">
                <input type="number" class="form-control" id='item-qty-{{ $item->id }}' />
            </div>
        </div>
    @else
        <div class="col-1">
            {{ $item->qty }}
            <input type="hidden" id='item-qty-{{ $item->id }}' value="{{ $item->qty }}" />
        </div>
    @endif

    <div class="col-1">
        <div class="input-group input-group-outline ">
            @if (!isset($add_item_list))
                <input type="number" class="form-control" id='item-unitprice-{{ $item->id }}'
                     min="1" />
            @else
                <input type="hidden" id='item-unitprice-{{ $item->id }}' value="{{ $item->unit_price }}" />
                {{ $item->unit_price }}
            @endif

        </div>
    </div>

    @if (isset($add_item_list))
        <div class="col-1">
            <div class="col-1">
                <p class="text text-danger" style="cursor:pointer" onclick="deleteUi('{{ $item->id }}')">remove</p>
            </div>
        </div>
    @endif


    </div>
@endforeach
