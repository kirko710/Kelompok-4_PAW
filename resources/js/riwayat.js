document.addEventListener('DOMContentLoaded', () => {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const container = document.getElementById('riwayatContainer');

    if (!filterBtns.length || !container) return;

    filterBtns.forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const url = btn.href;

            container.innerHTML = '<div style="text-align: center; padding: 60px 0; color: #666;">Sedang memuat data...</div>';

            try {
                const response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Network response was not ok');

                const result = await response.json();
                const data = result.data || [];
                let htmlContent = '';

                if (data.length === 0) {
                    htmlContent = `
                    <div style="text-align: center; padding: 60px 0;">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-cart-2130356-1800917.png" alt="Empty" style="width: 200px; opacity: 0.5;">
                        <p style="color: var(--text-secondary); margin-top: 20px;">Belum ada riwayat pemesanan untuk status ini.</p>
                    </div>`;
                } else {
                    data.forEach(item => {
                        let actionButtons = `<a href="${item.detail_url}" class="btn-sm btn-outline">Detail</a>&nbsp;`;

                        if (item.status_pesanan === 'pending') {
                            actionButtons += `<a href="${item.bayar_url}" class="btn-sm btn-primary-sm">Bayar Sekarang</a>`;
                        }

                        htmlContent += `
                        <div class="booking-card">
                            <div class="card-header">
                                <div class="venue-info">
                                    <div class="venue-icon">
                                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11m16-11v11"/></svg>
                                    </div>
                                    <div>
                                        <div class="venue-name">${item.venue_nama}</div>
                                        <div class="court-name">${item.lapangan_nama}</div>
                                    </div>
                                </div>
                                <span class="badge badge-${item.status_pesanan}">${item.status_text}</span>
                            </div>

                            <div class="card-body">
                                <div>
                                    <div class="info-label">Tanggal Main</div>
                                    <div class="info-value">${item.tanggal_main}</div>
                                </div>
                                <div>
                                    <div class="info-label">Waktu</div>
                                    <div class="info-value">${item.waktu_mulai} - ${item.waktu_selesai}</div>
                                </div>
                                <div>
                                    <div class="info-label">ID Pesanan</div>
                                    <div class="info-value">${item.id_pesanan_format}</div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="total-price">
                                    Total: <strong>Rp ${item.total_harga_format}</strong>
                                </div>
                                <div class="action-btns">
                                    ${actionButtons}
                                </div>
                            </div>
                        </div>
                        `;
                    });
                }

                container.innerHTML = htmlContent;
                window.history.pushState({}, '', url);
            } catch (error) {
                console.error('Error fetching data:', error);
                container.innerHTML = '<div style="text-align: center; padding: 60px 0; color: red;">Gagal memuat data. Silakan coba lagi.</div>';
            }
        });
    });
});