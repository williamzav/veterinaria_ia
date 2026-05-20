{{-- Modal Logout PRO --}}
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content border-0 shadow" style="border-radius:16px;overflow:hidden;">
            <div class="modal-body text-center p-4">
                <div style="width:64px;height:64px;border-radius:50%;background:rgba(231,74,59,.1);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <i class="fas fa-sign-out-alt fa-2x text-danger"></i>
                </div>
                <h5 class="font-weight-bold text-gray-800 mb-2">¿Cerrar sesión?</h5>
                <p class="text-muted small mb-4">Tu sesión actual se cerrará. Tendrás que volver a iniciar sesión para acceder.</p>
                <div class="d-flex" style="gap:.5rem;">
                    <button class="btn btn-light btn-block" type="button" data-dismiss="modal" style="border-radius:50px;">
                        Cancelar
                    </button>
                    <a class="btn btn-danger btn-block" href="{{ route('logout') }}" style="border-radius:50px;">
                        <i class="fas fa-sign-out-alt mr-1"></i> Salir
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
