<x-layouts.app title="Data Poli">
    <style>
        /* ====== Elegant Glassmorphism Style - Consistency for Data Poli ====== */
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
            color: var(--color-text-dark);
        }

        /* --- Card & Glass Effect --- */
        .card-glass {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(15px);
            border-radius: 1.25rem;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
            transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .card-glass:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.15);
        }

        /* --- Table Styling --- */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table th, .table td {
            padding: 1rem;
            vertical-align: middle;
            border-top: none !important;
        }

        .table thead th {
            background-color: rgba(255, 255, 255, 0.95);
            border-bottom: 2px solid var(--color-primary);
            font-weight: 600;
            color: var(--color-text-dark);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            text-align: center; /* Center header text */
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(74, 111, 165, 0.05);
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
            font-size: 0.85rem; /* Slightly larger buttons */
            padding: 0.4rem 0.8rem;
            margin: 0.1rem; /* Added margin for better spacing */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-warning:hover, .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
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
            border-left: 5px solid; /* Placeholder for color based on type */
            color: var(--color-text-dark);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.7s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
            transform: translateY(-30px);
            opacity: 0;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
        }

        .alert-success.alert-glass { border-left-color: var(--color-success); }
        .alert-danger.alert-glass { border-left-color: var(--color-danger); }
        .alert-warning.alert-glass { border-left-color: var(--color-warning); }

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

        .text-success { color: var(--color-success) !important; }
        .text-danger { color: var(--color-danger) !important; }
        .text-warning { color: var(--color-warning) !important; }
        .text-primary { color: var(--color-primary) !important; }


        .btn-close {
            /* Override default button close for aesthetic */
            background: none;
            border: none;
            font-size: 1rem;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .btn-close:hover {
            opacity: 1;
        }

        .table-responsive {
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
    </style>

    <div class="container-fluid px-4 mt-5 fade-in">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- Flash message (Alert Modern) --}}
                @if (session('message') || session('success'))
                    @php
                        // Determine the message and type
                        $msg = session('message') ?? session('success');
                        $type = session('type') ?? (session('success') ? 'success' : 'info');
                        $icon = '';
                        if ($type == 'success') $icon = 'fas fa-check-circle text-success';
                        elseif($type == 'danger') $icon = 'fas fa-times-circle text-danger';
                        elseif($type == 'warning') $icon = 'fas fa-exclamation-triangle text-warning';
                        else $icon = 'fas fa-info-circle text-primary';
                    @endphp
                    <div class="alert alert-{{ $type }} alert-glass d-flex align-items-center justify-content-between mx-auto mb-4" style="max-width: 600px;" role="alert" id="flashAlert">
                        <div class="d-flex align-items-center">
                            <i class="{{ $icon }} alert-icon"></i>
                            <div class="fw-medium">
                                <strong>{{ ucfirst($type) }}:</strong>&nbsp; {{ $msg }}
                            </div>
                        </div>
                        {{-- Using the custom close button to trigger animation --}}
                        <button type="button" class="btn-close" aria-label="Close" onclick="closeAlert()"></button>
                    </div>
                @endif
                
                {{-- Remove the old direct success alert --}}
                {{-- @if (session('success'))
                    <div class="alert alert-success" id="alert">{{ session('success') }}</div>
                @endif --}}

                <div class="card card-glass p-lg-5 p-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-2">
                        <h2 class="fw-bolder text-dark mb-2 mb-md-0" style="color: var(--color-text-dark) !important;">
                            <i class="fas fa-hospital me-2" style="color: var(--color-primary);"></i> Data Poli
                        </h2>
                        <a href="{{ route('polis.create') }}" class="btn btn-primary shadow-lg">
                            <i class="fas fa-plus me-1"></i> Tambah Poli Baru
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Nama Poli</th>
                                    <th>Keterangan</th>
                                    <th style="width: 20%;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($polis as $index => $poli )
                                    <tr>
                                        <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                        <td>{{ $poli->nama_poli }}</td>
                                        <td>{{ $poli->keterangan }}</td>
                                        <td class="text-center text-nowrap">
                                            <a href="{{ route('polis.edit', $poli->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('polis.destroy', $poli->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus Poli: {{ $poli->nama_poli }}?')">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-muted py-5" colspan="4">
                                            <i class="fas fa-folder-open me-2"></i> Belum ada data Poli yang tercatat.
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
        // Note: The original script only handled the 'success' alert by ID 'alert'.
        // This new script handles the modernized 'flashAlert' dynamically.
        setTimeout(closeAlert, 4000);
    </script>
</x-layouts.app>