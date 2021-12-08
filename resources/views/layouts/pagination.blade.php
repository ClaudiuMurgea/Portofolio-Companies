@if( $paginator->hasPages() )

    <ul class="d-flex justify-content-between">
        @if( $paginator->onFirstPage() )
        <li class="text-center border rounded text-muted btn btn-link" wire:click="previousPage()">
            &laquo; Previous    
        </li>
        @else 
        <li class="text-center border rounded text-success btn btn-link" wire:click="previousPage()">
            &laquo; Previous    
        </li>
        @endif

        @if(! $paginator->hasMorePages() )
            <li class="text-center border rounded text-muted btn btn-link" wire:click="nextPage()">
                &emsp; Next &raquo; &emsp;
            </li>
        @else 
            <li class="text-center border rounded text-success btn btn-link" wire:click="nextPage()">
                &emsp; Next &raquo; &emsp;
            </li>
        @endif

    </ul>

@endif

<script>
    feather.replace()
</script>