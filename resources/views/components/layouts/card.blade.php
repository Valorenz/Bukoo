<div id="dashboard" class="mb-4">
    <h2>Overview</h2>
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('member') }}" class="card text-white bg-primary mb-3" style="text-decoration: none;">
                <div class="card-header">
                    <span data-feather="users" class="mr-2"></span> Members
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total: {{ $member }}</h5>
                    <p class="card-text">Active Members</p>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('buku') }}" class="card text-white bg-success mb-3" style="text-decoration: none;">
                <div class="card-header">
                    <span data-feather="book" class="mr-2"></span> Books
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total: {{ $buku }}</h5>
                    <p class="card-text">Available Books</p>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('pinjam') }}" class="card text-white bg-warning mb-3" style="text-decoration: none;">
                <div class="card-header">
                    <span data-feather="file-text" class="mr-2"></span> Loans
                </div>
                <div class="card-body">
                    <h5 class="card-title">Active: {{ $pinjam }}</h5>
                    <p class="card-text">Books on Loan</p>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('kembali') }}" class="card text-white bg-danger mb-3" style="text-decoration: none;">
                <div class="card-header">
                    <span data-feather="clock" class="mr-2"></span> Returns
                </div>
                <div class="card-body">
                    <h5 class="card-title">Overdue: {{ $kembali }}</h5>
                    <p class="card-text">Overdue Books</p>
                </div>
            </a>
        </div>
    </div>
</div>
