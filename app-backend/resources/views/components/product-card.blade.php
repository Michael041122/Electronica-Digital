@props(['kit'])

<div class="product-item" data-category="{{ $kit->category->slug ?? 'cctv' }}">
    @if($kit->badge)
        <div class="product-badge-tag {{ strtolower($kit->badge) == 'ideal negocios' ? 'red' : '' }}">
            {{ $kit->badge }}
        </div>
    @endif

    <div class="product-img">
        <img src="{{ $kit->image_url ?? 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $kit->name }}" loading="lazy">
    </div>

    <div class="product-info">
        <span class="product-category">
            <i class="fa-solid {{ $kit->category->icon ?? 'fa-video' }}"></i> {{ $kit->category->name ?? 'Seguridad' }}
        </span>
        <h3>{{ $kit->name }}</h3>
        <p class="product-summary">{{ $kit->description ?? $kit->specs_summary }}</p>

        @if(!empty($kit->features))
            <ul class="product-specs">
                @foreach($kit->features as $feature)
                    <li><i class="fa-solid fa-check"></i> {{ $feature }}</li>
                @endforeach
            </ul>
        @endif

        <div class="product-action-row">
            <div class="price-box">
                <small>Precio aproximado</small>
                <strong>{{ $kit->estimated_price ? '$' . number_format($kit->estimated_price, 2) . ' MXN' : 'A Cotizar' }}</strong>
            </div>
            <button onclick="sendWhatsAppQuote('{{ addslashes($kit->name) }}', '{{ $kit->estimated_price ? '$' . number_format($kit->estimated_price, 2) . ' MXN' : 'A Cotizar' }}', '{{ addslashes($kit->specs_summary) }}', {{ $kit->id }})" class="btn btn-product-whatsapp">
                <i class="fa-brands fa-whatsapp"></i> Cotizar Kit
            </button>
        </div>
    </div>
</div>
