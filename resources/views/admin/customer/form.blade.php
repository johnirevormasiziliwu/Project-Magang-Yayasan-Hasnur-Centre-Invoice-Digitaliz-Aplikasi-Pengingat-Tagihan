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
                            <h1 class="text-hover-primary fw-bold text-black">User</h1>
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
                <form action="{{ $url }}" method="post" id="myForm">
                    @csrf
                    @if (@$customer)
                        @method('put')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name_agency" class="form-label fs-4 fw-bold">Nama Instansi</label>
                            <input type="text" name="name_agency" id="name_agency"
                                value="{{ old('name_agency', @$customer->name_agency) }}"
                                class="form-control @error('name_agency') is-invalid @enderror"
                                placeholder="Type here...">
                            @error('name_agency')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="name_unit" class="form-label fs-4 fw-bold">Nama Unit</label>
                            <input type="text" name="name_unit" id="name_unit"
                                value="{{ old('name_unit', @$customer->name_unit) }}"
                                class="form-control @error('name_unit') is-invalid @enderror"
                                placeholder="Type here...">
                            @error('name_unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="no_handphone" class="form-label fs-4 fw-bold">No. Handphone</label>
                            <input type="text" name="no_handphone" id="no_handphone"
                                value="{{ old('no_handphone', @$customer->no_handphone) }}"
                                class="form-control @error('no_handphone') is-invalid @enderror"
                                placeholder="Type here...">
                            @error('no_handphone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="name_pic" class="form-label fs-4 fw-bold">Nama PIC</label>
                            <input type="text" name="name_pic" id="name_pic"
                                value="{{ old('name_pic', @$customer->name_pic) }}"
                                class="form-control @error('name_pic') is-invalid @enderror" placeholder="Type here...">
                            @error('name_pic')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="address" class="col-form-label d-md-inline-block text-truncate"
                            style="max-width: 100%;">
                            <span class="form-label fs-4 fs-md-3 fs-lg-4 fw-bold d-inline-block">Alamat</span>
                            <i class="d-inline-block"> (Nama Jalan, Gedung, RT/RW, Kecamatan, Kabupaten, Kode Pos
                                dll)</i>
                        </label>
                        <div class="input-group">
                            <textarea name="address" id="address" cols="30" rows="8"
                                class="form-control @error('address') is-invalid @enderror" placeholder="Type here...">{{ old('address', @$customer->address) }}</textarea>
                        </div>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="address" class="form-label fs-4 fw-bold">Alamat E-mail</label>
                        <input type="email" name="email" id="email"
                            value="{{ old('email', @$customer->email) }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Type here...">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="password" class="form-label fs-4 fw-bold ">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password"
                                    value="{{ @$customer->password }}"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Type here...">
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
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Type here...">
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

                    <div class="row float-end mt-5">
                        <div class="col">
                            <a href="{{ route('admin.customer.index') }}" class="btn"
                                style="background: #ffffff; border-color:#6e11f4">
                                Batal
                            </a>
                        </div>
                        <div class="col">
                            <button id="submitButton" disabled type="submit" class="btn"
                                style="background: #6e11f4; color: #ffffff">Selesai</button>
                        </div>
                    </div>
                </form>
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


        // button disabled


        const form = document.getElementById('myForm');
        const submitButton = document.getElementById('submitButton');
        const originalData = new FormData(form);

        form.addEventListener('input', () => {
            // Cek apakah data form berubah dari data asli
            const formData = new FormData(form);
            let isDataChanged = false;
            for (const pair of originalData.entries()) {
                if (pair[1] !== formData.get(pair[0])) {
                    isDataChanged = true;
                    break;
                }
            }

            // Aktifkan atau nonaktifkan tombol berdasarkan perubahan data
            if (isDataChanged) {
                submitButton.removeAttribute('disabled');
            } else {
                submitButton.setAttribute('disabled', 'disabled');
            }
        });
    </script>
</x-app-layout>
