<x-app-layout>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page mb-5">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="card">
                                <div class="card-body">
                                    <span class="icon" style="color:#6e11f4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            strokeWidth="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>

                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="flex-grow-1 ms-3">

                            <h1 class="text-hover-primary fw-bold">User</h1>

                            <span class="d-block fs-3">Akses menu dan informasi penting lainya disini</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <a class="btn btn-sm text-white fw-bold" href="{{ route('admin.customer.index') }}"
                        style="background: #EFEFEF">
                        <i class="bi bi-arrow-left text-black fs-5 fw-bold"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- star form --->

        <div class="card mt-5">
            <div class="card-body">
        
                <div class="row">
                    <div class="col-md-6">
                        <label for="name_agency" class="form-label fs-4 fw-bold">Nama Instansi</label>
                        <input type="text" name="name_agency" id="name_agency" value="{{ @$customer->name_agency }}"
                            class="form-control" placeholder="Type here...">
                    </div>
                    <div class="col-md-6">
                        <label for="name_unit" class="form-label fs-4 fw-bold">Nama Unit</label>
                        <input type="text" name="name_unit" id="name_unit" value="{{ @$customer->name_unit }}"
                            class="form-control" placeholder="Type here...">
                    </div>
                </div>
        
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="no_handphone" class="form-label fs-4 fw-bold">No. Handphone</label>
                        <input type="text" name="no_handphone" id="no_handphone" value="{{ @$customer->no_handphone }}"
                            class="form-control" placeholder="Type here...">
                    </div>
                    <div class="col-md-6">
                        <label for="name_pic" class="form-label fs-4 fw-bold">Nama PIC</label>
                        <input type="text" name="name_pic" id="name_pic" value="{{ @$customer->name_pic }}"
                            class="form-control" placeholder="Type here...">
                    </div>
                </div>
        
                <div class="mb-3 mt-3">
                    <label for="address" class="col-form-label d-md-inline-block text-truncate" style="max-width: 100%;">
                        <span class="form-label fs-4 fs-md-3 fs-lg-4 fw-bold d-inline-block">Alamat</span>
                        <i class="d-inline-block"> (Nama Jalan, Gedung, RT/RW, Kecamatan, Kabupaten, Kode Pos dll)</i>
                    </label>
                  <textarea name="address" id="address" cols="30" rows="8" class="form-control">{{ @$customer->address }}</textarea>
                </div>
        
                <div class="mb-3 mt-3">
                    <label for="address" class="form-label fs-4 fw-bold">Alamat E-mail</label>
                    <input type="email" name="email" id="email" value="{{ @$customer->email }}" class="form-control">
                </div>
        
                <div class="row">
                    <div class="col-md-6">
                        <label for="password" class="form-label fs-4 fw-bold ">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" value="{{ @$customer->password }}"
                                class="form-control @error('password') is-invalid @enderror">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePassword('password')">
                                <i id="password-icon" class="bi bi-eye-fill"></i>
                            </button>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label fs-4 fw-bold">Konfirmasi
                            Password</label>
                        <div class="input-group">
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                value="{{ @$customer->password }}"
                                class="form-control @error('password') is-invalid @enderror">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePassword('password_confirmation')">
                                <i id="password_confirmation-icon" class="bi bi-eye-fill"></i>
                            </button>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                <div class="row mt-5">
                    <div class="col">
                        <a href="{{ route('admin.customer.index') }}" class="btn"
                            style="background: #6e11f4; color:white;">
                            Kembali
                        </a>
                    </div>
                </div>
        
            </div>
        </div>
        
        <!-- end form --->

    </div>
    <script>
        function togglePassword(fieldId) {
            var passwordField = document.getElementById(fieldId);
            var passwordIcon = document.getElementById(fieldId + '-icon');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordIcon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
            } else {
                passwordField.type = "password";
                passwordIcon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
            }
        }
    </script>
</x-app-layout>
