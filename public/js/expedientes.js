document.addEventListener('DOMContentLoaded', function () {
    const searchInput   = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    if (!searchInput || !searchResults) return;

    const searchUrl = searchInput.dataset.url;
    let debounceTimer;

    // Ocultar al hacer clic fuera
    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });

    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        const query = this.value.trim();

        if (query.length < 1) {
            searchResults.style.display = 'none';
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`${searchUrl}?q=${encodeURIComponent(query)}`, {
                credentials: 'same-origin',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(response => {
                if (!response.ok) throw new Error('Error en la respuesta: ' + response.status);
                return response.json();
            })
            .then(data => {
                searchResults.innerHTML = '';

                if (!Array.isArray(data) || data.length === 0) {
                    searchResults.innerHTML = `
                        <div style="padding:12px 16px; color:#888; font-size:.9rem;">
                            <i class="fas fa-search-minus mr-1"></i> No se encontraron resultados.
                        </div>`;
                } else {
                    data.forEach(item => {
                        const dueno = item.dueno ? item.dueno.nombre_completo : 'Sin dueño';
                        const el = document.createElement('a');
                        el.href = `/pacientes?q=${encodeURIComponent(item.nombre)}`;
                        el.style.cssText = 'display:block; padding:10px 16px; border-bottom:1px solid #f0f0f0; text-decoration:none; color:#333;';
                        el.innerHTML = `
                            <div style="font-weight:700; color:#333;">
                                <i class="fas fa-paw" style="color:#4e73df;margin-right:6px;"></i>${item.nombre}
                                <span style="background:#17a2b8;color:#fff;border-radius:50px;padding:1px 8px;font-size:.75rem;margin-left:6px;">Folio: ${item.id}</span>
                            </div>
                            <div style="font-size:.8rem;color:#888;margin-top:3px;">
                                <i class="fas fa-user" style="margin-right:4px;"></i>${dueno}
                                ${item.especie ? `&nbsp;·&nbsp;${item.especie}` : ''}
                            </div>`;
                        el.addEventListener('mouseenter', () => el.style.background = '#f8f9fc');
                        el.addEventListener('mouseleave', () => el.style.background = '#fff');
                        searchResults.appendChild(el);
                    });
                }

                searchResults.style.display = 'block';
            })
            .catch(error => {
                console.error('Buscador error:', error);
                searchResults.innerHTML = `
                    <div style="padding:12px 16px; color:#e74a3b; font-size:.9rem;">
                        <i class="fas fa-exclamation-circle mr-1"></i> Error al buscar. Intenta de nuevo.
                    </div>`;
                searchResults.style.display = 'block';
            });
        }, 300);
    });
});
