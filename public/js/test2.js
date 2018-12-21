(function() {
    document.querySelector('#uploadForm').addEventListener('submit', function (e) {
        e.preventDefault()
        axios.post(this.action, {
            'doc_type': document.querySelector('#doc_type').value,
            'doc_file': document.querySelector('#doc_file').value
        })
            .then(function (response) {
                // window.location.href = '{{ route('create') }}'
                clearErrors();
                this.reset();
                this.insertAdjacentHTML('afterend', '<div class="alert alert-success" id="success">User created successfully!</div>');
            })
            .catch(function (error) {
                console.log(error.response.data);
                console.log(error.response.status);
                console.log(error.response.headers);
                const errors = error.response.data;
                const firstItem = Object.keys(errors)[0];
                const firstItemDOM = document.getElementById(firstItem);
                const firstErrorMsg = errors[firstItem][0];

                // console.log(error.response.data);

                const errorMessages = document.querySelectorAll('.help-block');
                errorMessages.forEach(function (element) {element.textContent = ''});

                clearErrors();

                firstItemDOM.insertAdjacentHTML('afterend', '<span class="help-block">'+ firstErrorMsg +'</span>');

                firstItemDOM.classList.add('border', 'border-danger')
            });
    });

    function clearErrors() {
        // remove all error messages
        const errorMessages = document.querySelectorAll('.help-block');
        errorMessages.forEach(function (element) {element.textContent = ''});
        // remove all form controls with highlighted error text box
        const formControls = document.querySelectorAll('.form-control')
        formControls.forEach((function (element) {element.classList.remove('border', 'border-danger')}));
    }
})();