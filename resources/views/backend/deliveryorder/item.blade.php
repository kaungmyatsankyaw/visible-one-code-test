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
        {{ $item->note->bl_number }}
    </div>
    <div class="col-1">
        {{ $item->note->customer?->name }}
    </div>
    <div class="col-1">
        {{ $item->item_description }}
    </div>
    <div class="col-2">
        {{ $item->container_number }} - {{ $item->thai_number }}
    </div>
    <div class="col-1">
        {{ $item->recieved_qty }}
    </div>
    <div class="col-1">

        <input type="hidden" value="{{ $item->qty_balance }}" id='recQty-{{ $item->id }}' />
        @if (!isset($add_item_list))
            <input type="hidden" id='balQty-{{ $item->id }}' />
            <input type="hidden" id='qtyOut-{{ $item->id }}' />
        @else
            <input type="hidden" id='balQty-{{ $item->id }}' value="{{ $item->qty_balance }}" />
            <input type="hidden" id='qtyOut-{{ $item->id }}' value="{{ $item->qty_out }}" />
        @endif



        <div id='item-qty-balance-{{ $item->id }}'> {{ $item->qty_balance }}</div>


    </div>
    <div class="col-2">
        <div class="input-group input-group-outline  w-50">
            @if (!isset($add_item_list))
                <input type="number" class="form-control" id='item-qty-balance-{{ $item->id }}'
                    oninput="calQtyBalance({{ $item->id }},this)" min="1" />
            @else
                {{ $item->qty_out }}
            @endif

        </div>
    </div>

    @if (!isset($add_item_list))
        <div class="col-2">
            <div class="input-group input-group-outline  w-50">
                <input type="text" class="form-control" id='item-remark-{{ $item->id }}' />
            </div>
        </div>
    @else
        <div class="col-1">
            {{ $item->remark }}
            <input type="hidden" id='item-remark-{{ $item->id }}' value="{{ $item->remark }}" />

        </div>
        <div class="col-1">
            <p class="text text-danger" style="cursor:pointer" onclick="deleteUi('{{ $item->id }}')">remove</p>
        </div>
    @endif


    </div>
@endforeach
