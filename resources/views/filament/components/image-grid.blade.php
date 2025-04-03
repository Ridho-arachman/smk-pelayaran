@if($getState())
    <div class="grid grid-cols-4 gap-4">
        @foreach($getState() as $document)
            <div class="relative">
                <img 
                    src="{{ asset('storage/' . $document) }}" 
                    class="w-24 h-24 rounded-full object-cover"
                    loading="lazy"
                >
            </div>
        @endforeach
    </div>
@endif