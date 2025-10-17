<x-layouts.app title="Data Dokter">
    <style>
        /* ====== Elegant Glassmorphism Style - Revised ====== */
        :root {
            /* Elegant Palette */
            --color-background-start: #f0f4f8; /* Very Light Blue-Gray */
            --color-background-end: #dce1e7; /* Light Gray-Blue */
            --color-primary: #4a6fa5; /* Steel Blue - Main Action Color */
            --color-secondary: #7e94b2; /* Soft Blue-Gray */
            --color-warning: #ffb74d; /* Soft Amber */
            --color-danger: #e57373; /* Muted Red */
            --color-success: #81c784; /* Soft Green */
            --color-info: #64b5f6; /* Light Blue */
            --color-text-dark: #37474f; /* Dark Blue Gray */
            --color-text-light: #eceff1;
        }

        body {
            background: linear-gradient(135deg, var(--color-background-start), var(--color-background-end));
            min-height: 100vh;
            color: var(--color-text-dark); /* Default text color */
        }

        /* --- Card & Glass Effect --- */
        .card-glass {
            background: rgba(255, 255, 255, 0.5); /* Lighter transparency */
            backdrop-filter: blur(15px); /* Stronger blur for depth */
            border-radius: 1.25rem; /* Slightly more rounded */
            border: 1px solid rgba(255, 255, 255, 0.4); /* Subtle white border */
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1); /* Deeper shadow */
            transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .card-glass:hover {
            transform: translateY(-2px); /* Subtle lift */
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.15);
        }

        /* --- Table Styling --- */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table th, .table td {
            padding: 1rem; /* More vertical padding */
            border-top: none !important;
        }

        .table thead th {
            background-color: rgba(255, 255, 255, 0.95); /* Near opaque header */
            border-bottom: 2px solid var(--color-primary); /* Accent line */
            font-weight: 600;
            color: var(--color-text-dark);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(74, 111, 165, 0.05); /* Light hover with primary color */
            transform: none; /* Removed scale for a cleaner look */
        }

        /* --- Buttons --- */
        .btn-primary {
            background: linear-gradient(135deg, var(--color-primary), #6c8dbb);
            border: none;
            box-shadow: 0 4px 10px rgba(74, 111, 165, 0.3);
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(74, 111, 165, 0.4);
            background: linear-gradient(135deg, #6c8dbb, var(--color-primary));
        }

        .btn-warning, .btn-danger {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            transition: transform 0.2s ease;
        }

        .btn-warning:hover, .btn-danger:hover {
            transform: translateY(-1px);
        }

        /* --- Badge (Poli) --- */
        .badge-poli {
            background-color: var(--color-secondary);
            color: var(--color-text-light);
            padding: 0.4em 0.8em;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.75rem;
        }

        /* --- Global Animations --- */
        .fade-in {
            animation: fadeInUp 1s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- Animated Alert --- */
        .alert-glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-left: 5px solid var(--color-primary); /* Using primary color accent */
            color: var(--color-text-dark);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.7s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
            transform: translateY(-30px);
            opacity: 0;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
        }

        @keyframes slideDown {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .alert-glass.fade-out {
            animation: slideUpFade 0.5s ease forwards;
        }

        @keyframes slideUpFade {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        .alert-icon {
            font-size: 1.5rem;
            margin-right: 12px;
            min-width: 20px;
        }

        /* Custom Colors for Icons/Text */
        .text-success { color: var(--color-success) !important; }
        .text-danger { color: var(--color-danger) !important; }
        .text-warning { color: var(--color-warning) !important; }
        .text-primary { color: var(--color-primary) !important; }


        .btn-close-custom {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--color-secondary);
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .btn-close-custom:hover {
            transform: scale(1.1);
            color: var(--color-text-dark);
        }

        /* Fix for the thead border-radius issue in some browsers */
        .table-responsive {
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); /* Added subtle table shadow */
        }
    </style>

    <div class="container-fluid px-4 mt-5 fade-in">
        <div class="row justify-content-center">
            <div class="col-lg-11">

                {{-- Flash message (alert modern) --}}
                @if (session('message'))
                    <div class="alert alert-glass d-flex align-items-center justify-content-between mx-auto mb-4" style="max-width: 600px;" role="alert" id="flashAlert">
                        <div class="d-flex align-items-center">
                            @php
                                $type = session('type', 'info');
                                $icon = '';
                                if ($type == 'success') $icon = 'fas fa-check-circle text-success';
                                elseif($type == 'danger') $icon = 'fas fa-times-circle text-danger';
                                elseif($type == 'warning') $icon = 'fas fa-exclamation-triangle text-warning';
                                else $icon = 'fas fa-info-circle text-primary';
                            @endphp
                            <i class="{{ $icon }} alert-icon"></i>
                            <div class="fw-medium">
                                <strong>{{ ucfirst($type) }}:</strong>&nbsp; {{ session('message') }}
                            </div>
                        </div>
                        <button class="btn-close-custom" onclick="closeAlert()" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                <div class="card card-glass p-lg-5 p-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-2">
                        <h2 class="fw-bolder text-dark mb-2 mb-md-0" style="color: var(--color-text-dark) !important;">
                            <i class="fas fa-user-md me-2" style="color: var(--color-primary);"></i> Data Dokter
                        </h2>
                        <a href="{{ route('dokter.create') }}" class="btn btn-primary shadow-lg">
                            <i class="fas fa-plus me-1"></i> Tambah Dokter Baru
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-striped mb-0">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Alamat</th>
                                    <th style="width: 15%;">Poli</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dokters as $index => $dokter)
                                    <tr>
                                        <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                        <td>{{ $dokter->nama }}</td>
                                        <td>{{ $dokter->email }}</td>
                                        <td>{{ $dokter->no_hp }}</td>
                                        <td>{{ $dokter->alamat }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-poli">
                                                {{ $dokter->poli->nama_poli ?? 'Belum Dipilih' }}
                                            </span>
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-sm btn-warning me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data dokter {{ $dokter->nama }}?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="fas fa-folder-open me-2"></i> Belum ada data dokter yang tercatat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert animation script --}}
    <script>
        const closeAlert = () => {
            const alert = document.getElementById('flashAlert');
            if (alert) {
                alert.classList.add('fade-out');
                setTimeout(() => alert.remove(), 500);
            }
        };

        // Auto close after 4 seconds for a slightly longer read time
        setTimeout(closeAlert, 4000);
    </script>
</x-layouts.app>