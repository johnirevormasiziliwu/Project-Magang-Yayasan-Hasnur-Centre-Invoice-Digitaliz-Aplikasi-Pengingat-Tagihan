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
                <div class="col-sm-auto mt-3 mt-sm-0">
                    <a class="btn btn-sm text-white fw-bold text-black" href="{{ route('admin.customer.create') }}"
                        style="background: #6e11f4">
                        <i class="bi bi-plus fs-4"></i> Buat User
                    </a>
                </div>
            </div>
        </div>
        
        <!-- End Page Header -->




        <div class="card mt-5">
            <div class="card-body">
                <form action="{{ route('admin.multi-delete') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="text-end">
                            <input type="hidden" name="action" value="">
                            <button type="submit" class="btn btn-sm bg-white delete-btn  border border-dark fs-5"
                                onclick="setAction('delete')" id="btn-delete" disabled>
                                <i class="bi bi-trash3" name="action" value="delete"></i> Delete
                            </button>
                        </div>
                    </div>
        
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th><input type="checkbox" class="check_all" id="checkAll"></th>
                                    <th scope="col" class="fw-bold">Nama Instansi</th>
                                    <th scope="col" class="fw-bold">Nama Unit</th>
                                    <th scope="col" class="fw-bold">Nama PIC</th>
                                    <th scope="col" class="fw-bold">No Handphone</th>
                                    <th scope="col" class="fw-bold">Email</th>
                                    <th scope="col" class="fw-bold">Profile</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                    <tr>
                                        <td><input type="checkbox" name="customer[]" value="{{ $customer->id }}"
                                                class="checkbox-item"></td>
                                        <td>{{ $customer->name_agency }}</td>
                                        <td>{{ $customer->name_unit }}</td>
                                        <td>{{ $customer->name_pic }}</td>
                                        <td>{{ $customer->no_handphone }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            <div class="d-flex flex-row">
                                                <a href="{{ route('admin.customer.show', $customer) }}">
                                                    <u style="color: #6e11f4">Detail</u>
                                                </a>
                                                <a class="text-dark ms-3" href="{{ route('admin.customer.edit', $customer) }}">
                                                    <i class="bi bi-pencil mr-3"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-danger">
                                            <i class="bi bi-exclamation-triangle-fill d-block mx-auto my-3"
                                                style="font-size: 3rem;"></i> No Data User
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>
        
                <div class="d-flex justify-content-center mt-5">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
        
    </div>
    </div>

    @include('scripts.delete')
    @include('scripts.btndeletecustomer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        </script>

    <script>
        function setAction(action) {
            document.getElementsByName('action')[0].value = action; // set nilai input hidden
        }

        const checkboxes = document.querySelectorAll('input[name="customer[]"]');
        const btnDelete = document.getElementById('btn-delete');
        const checkAll = document.getElementById('checkAll');


        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('click', () => {
                const checkedCheckboxes = document.querySelectorAll('input[name="customer[]"]:checked');

                if (checkedCheckboxes.length === 0) {
                    btnDelete.disabled = true;
                } else {
                    btnDelete.disabled = false;
                }

            });
        });
       
       $("#checkAll").click(function () {

             if ($(this).prop("checked"))  {
                btnDelete.disabled = false;
            } else {
                btnDelete.disabled = true;
            }
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

    </script>
   
    
    
</x-app-layout>
