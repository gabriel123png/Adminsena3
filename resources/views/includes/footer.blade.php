<footer class="bg-dark text-white mt-5">

    <div class="container py-4">

        <div class="row">

            <!-- Información -->
            <div class="col-md-6">

                <h5>AdminSena</h5>

                <p>
                    Sistema de administración del SENA.
                </p>

            </div>


            <!-- Enlaces -->
            <div class="col-md-6">

                <h5>Accesos rápidos</h5>

                <ul class="list-unstyled">

                    <li>
                        <a
                            href="{{ route('home') }}"
                            class="text-white text-decoration-none">

                            Inicio

                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('areas.index') }}"
                            class="text-white text-decoration-none">

                            Áreas

                        </a>
                    </li>

                </ul>

            </div>

        </div>


        <hr>


        <div class="text-center">

            <p class="mb-0">

                © {{ date('Y') }} AdminSena

            </p>

        </div>

    </div>

</footer>