<div class="card-footer clearfix">
	<!---
    <div class="col-sm-12 col-md-4">
        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
            Exibindo página {{ $data->currentPage() }} de {{ $data->lastPage() }}
        </div>
    </div> -->

    @if($data->total() > $data->perPage())
        <ul class="pagination pagination-sm m-0 float-right">
            @if(!$data->onFirstPage())
                <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}">«</a></li>
            @endif


            @for($i = 1; $i <= $data->lastPage(); $i++)
                <li class="page-item">
                    <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if($data->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $data->nextPageUrl() }}">»</a></li>
            @endif
        </ul>
    @endif
</div>
