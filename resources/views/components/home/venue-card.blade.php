@forelse($venues ?? [] as $venue)
    <div class="venue-card">
        <a href="{{ route('venue.show', $venue->id) }}">
            <img class="venue-card__image"
                 src="{{ $venue->foto_url ?? 'https://placehold.co/349x349' }}"
                 alt="{{ $venue->nama ?? 'Venue' }}">
        </a>
        <div class="venue-card__body">
            <div>
                <a href="{{ route('venue.show', $venue->id) }}" class="venue-card__name">
                    {{ $venue->nama ?? 'Unnamed Venue' }}
                </a>
                @if($venue->lapangans && $venue->lapangans->count() > 0)
                    <p class="venue-card__meta">{{ $venue->lapangans->first()->jenis_olahraga ?? 'Tipe Lapangan' }}</p>
                @endif
                <p class="venue-card__meta">{{ $venue->lokasi ?? 'Lokasi' }}</p>
            </div>
            @if($venue->lapangans && $venue->lapangans->count() > 0)
                <p class="venue-card__price">Rp {{ number_format($venue->lapangans->first()->harga_sewa ?? 0, 0, ',', '.') }}/jam</p>
                <div class="venue-card__schedules">
                    <p class="text-xs text-gray-600 mb-2">
                        <strong>Jam Operasional:</strong> {{ $venue->lapangans->first()->jam_buka ?? '07:00' }} - {{ $venue->lapangans->first()->jam_tutup ?? '22:00' }}
                    </p>
                </div>
            @endif
        </div>
    </div>
@empty
    <p>Tidak ada venue tersedia.</p>
@endforelse