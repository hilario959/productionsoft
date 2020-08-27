@extends('home')@section('content')
<div class="container">
    <div class="row">
    <a class="float-right" href="{{ route('production.index') }}">{{ __('Back') }}</a>
        <div class="col-md-12">
          <ul class="nav nav-tabs mb-5">
              <li class="nav-item">
                  <a class="nav-link" href="edit">{{ __('Products Produced') }}</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" href="edit2">{{ __('Orders Fulfilled') }}</a>
              </li>
          </ul>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
                @endif 
                <div class="col-md-12">
                  <div class="table-responsive">
                    <div id="example-table"></div>
                  </div>
              </div>
        </div>
    </div>
</div>


@endsection

<script>

  var nestedData = <?php echo json_encode($orders); ?>;
  console.log(nestedData)
  
  window.addEventListener("load", function() {  
    var nestedDatax = [{
      id: 26,
      created: "2020-07-27 12:21:17",
      actions: '<a href="http://productionsoft.local/home/production/1595870477/edit" class="btn btn-link">View</a>',
      serviceHistory: [
        {
          date: "01/02/2016",
          engineer: "Steve Boberson",
          actions: "Changed oli filter"
        }
    ]
  }]
  console.log(nestedDatax)
  
  
  var hideIcon = function(cell, formatterParams, onRendered){ //plain text value
      return "<i class='fas fa-chevron-circle-down'></i>";
  };
  
  const mainColumnHeaders = [
      {
        formatter:hideIcon, 
        align:"center", 
        title:" &nbsp;", 
        headerSort:false, 
        cellClick:function(e, row, formatterParams){
          const id = row.getData().id;
          $(".subTable" + id + "").toggle();      
        }
      },
      {
        title: "Order",
        field: "order"
      },
      {
        title: "Client Name",
        field: "client_name"
      },
      {
        title: "Time Delivery",
        field: "time_delivery",
      }
    ];
  
  const table = new Tabulator("#example-table", {
    height: "100%",
    layout: "fitDataStretch",
    resizableColumns: true,
    data: nestedData,
    selectable: true,
    columns: mainColumnHeaders,
    rowFormatter: function(row, e) {
      //create and style holder elements
      var holderEl = document.createElement("div");
      var tableEl = document.createElement("div");
  
      const id = row.getData().id;
  
      holderEl.style.boxSizing = "border-box";
      holderEl.style.padding = "10px 10px 10px 10px";
      holderEl.style.borderTop = "1px solid #333";
      holderEl.style.borderBotom = "1px solid #333";
      holderEl.style.background = "#fff";
      holderEl.setAttribute('class', "subTableHolder subTableHolder" + id + "");
      
      
      tableEl.style.border = "1px solid #333";
      tableEl.setAttribute('class', "subTable" + id + "");
      tableEl.setAttribute('style', "display:none");
  
      holderEl.appendChild(tableEl);
  
      row.getElement().appendChild(holderEl);
  
      var subTable = new Tabulator(tableEl, {
        layout: "fitDataStretch",
        data: row.getData().serviceHistory,
        columns: [{
            title: "Product",
            field: "name"
          },
          {
            title: "Quantity",
            field: "quantity"
          },
          {
            title: "Remaining Quantity",
            field: "remaining_quantity"
          },
        ]
      })
    },
  });
  
  });
  </script>