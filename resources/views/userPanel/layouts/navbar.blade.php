<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">casino</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('cabinet.slots.index') }}">SLOTS</a>
                    </li>
                @endauth
            </ul>
            <ul class="navbar-nav">

                @auth
                    <button class="btn btn-warning text-white">
                        balance: {{ auth()->user()->balance }}
                    </button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#depositModal" style="">deposit</button>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ auth()->user()->username }}</a>
                        <ul class="dropdown-menu">
                            <a href="{{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline nav-link btn btn-danger text-white">Log out</a>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('loginPage') }}"
                            class="text-sm text-gray-700 dark:text-gray-500 underline nav-link btn btn-success text-white">Log
                            in</a>
                    </li>
                    @if (Route::has('registerPage'))
                        <li class="nav-item">
                            <a href="{{ route('registerPage') }}"
                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline nav-link btn btn-danger text-white">
                                Registration
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

@auth
    <div class="modal fade" id="depositModal" tabindex="-1" aria-labelledby="depositModalLgLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="depositModalLgLabel">
                        <button type="button" role="button" href="#depositCarusel" data-bs-target="#depositCarusel"
                            data-bs-slide="prev" class="btn btn-danger">deposit</button>
                        <button type="button" role="button" href="#depositCarusel" data-bs-target="#depositCarusel"
                            data-bs-slide="next" class="btn btn-danger">withdraw</button>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="depositCarusel" class="carousel slide" data-bs-wrap="false" data-bs-interval="false">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <form action="{{ route('cabinet.deposit') }}" method="post">
                                    @csrf
                                    <div class="row justify-content-center">
                                        <input type="hidden" name="type" value="deposit">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Deposit</label>
                                            <input type="number" name="amount" class="form-control" id="amount"
                                                placeholder="Amount" min="0" step="0.1">
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-success">Deposit</button>
                                </form>
                            </div>
                            <div class="carousel-item">
                                <form action="{{ route('cabinet.withdraw') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="type" value="withdraw">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Withdraw</label>
                                        <input type="number" name="amount" class="form-control" id="amount"
                                            placeholder="Amount" min="0" step="0.1">
                                    </div>
                                    <button type="submit" class="btn btn-success">Withdraw</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endauth
