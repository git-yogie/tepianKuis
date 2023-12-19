<script>
    const modal = new bootstrap.Modal(document.getElementById('user_form'))
    const form = document.getElementById('user_form_action')
    const tambahButton = document.getElementById('user_add_button')
    const editButton = document.getElementById('user_edit_button')
    let idUser = null;
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })


    const tambah = () => {

        form.reset();
        validatorClear()
        tambahButton.classList.remove('d-none')
        editButton.classList.add('d-none')
        document.getElementById('user_form_title').innerHTML = "Tambah Pengguna"

        modal.show()
    }

    tambahButton.addEventListener('click', () => {
        const data = new FormData(form)
        axios.post("{{ route('admin.api.user.add') }}", data)
            .then((response) => {
                Toast.fire({
                    icon: 'success',
                    title: 'User berhasil ditambahkan'
                })
                renewData()
                modal.hide()
            })
            .catch((error) => {

                validator(error.response.data.errors)
            })
    })
    const formInput = ['nama', 'email']

    edit = (id) => {
        tambahButton.classList.add('d-none')
        editButton.classList.remove('d-none')
        document.getElementById('user_form_title').innerHTML = "Edut Pengguna"
        idUser = id
        axios.get("{{ route('admin.api.user') }}/" + id)
            .then((response) => {
                const data = response.data
                formInput.forEach((item) => {
                    document.getElementById(item).value = data[item]
                })
                modal.show()
            })
            .catch((error) => {
                console.log(error)
            })
        modal.show()
    }

    editButton.addEventListener("click", () => {
        const data = new FormData(form)
        axios.post("{{ route('admin.api.user.edit', '') }}/" + idUser, data)
            .then((response) => {
                Toast.fire({
                    icon: 'success',
                    title: 'User berhasil diubah'
                })
                renewData()
                modal.hide()
            })
            .catch((error) => {
                validator(error.response.data.errors)
            })
    })

    hapus = (id) => {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Seluruh data user yang ada akan ikut terhapus dan tidak bisa dikembalikan kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete("{{ route('admin.api.user.delete', '') }}/" + id)
                    .then((response) => {
                        Swal.fire(
                            'Deleted!',
                            'User berhasil dihapus',
                            'success'
                        )
                        renewData()
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    })

            }
        })
    }

    validator = (error) => {
        const validation = ['nama', 'email', 'password']

        validation.forEach((item) => {
            console.log(error[item], item)
            document.getElementById(item).classList.add('is-invalid')
            document.getElementById(item + '_validation').innerHTML = error[item][0]
        })
    }

    validatorClear = () => {
        const validation = ['nama', 'email', 'password']

        validation.forEach((item) => {
            document.getElementById(item).classList.remove('is-invalid')
            document.getElementById(item + '_validation').innerHTML = ''
        })
    }

    login = (id, nama) => {
        Swal.fire({
            title: 'Memasuki Area User ' + nama,
            text: "anda akan memasuki area user dan tidak bisa kembali ke area admin lagi! login admin kembali untuk masuk ke area admin",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Masuk!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.get("{{ route('admin.api.user.login',"") }}/" + id)
                    .then((response) => {
                        window.location.href = "{{ route('dashboard') }}"
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    })
            }
        })
    }
</script>
