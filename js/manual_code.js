$(document).ready(function () {

    /*Display Candidate List*/
    displayCandidate();

    /*Upload bulk voter list functionalities*/
    var uploadBulkVoterBtn = $('#uploadBulkVoterBtn');
    var uploadBulkVoterForm = $('#uploadVoterExcelFileForm');

    var loader = $('#loader');
    $(uploadBulkVoterBtn).on('click', function () {
        uploadBulkVoter();
    });
   function uploadBulkVoter() {
        $(uploadBulkVoterForm).submit();
   }

    function displayCandidate() {
        var displayCandidate = "true";
        $.ajax({
            url: "candidateview.php",
            type: 'post',
            data: {
                candidateDisplay: displayCandidate
            },
            success: function (data, status) {
                $("#displaycandidate").html(data);
            }
        });
    }

    var addCandidateBtn = $('#addCandidateBtn');
    var errorMsgContainer = $('.errorMsgContainer');
    var addCandidateModal = $('#addCandidateModal');
    var updateCandidateModal = $('#updateCandidateModal');
    var addCandidateForm = $('#addCandidateForm');

    $(addCandidateForm).on('submit', function (e) {
        e.preventDefault();
        addCandidate();
    });

    $(document).on('click', '#deleteCandidateBtn', function () {
        let candidateId = $(this).data('id');
        deleteCandidate(candidateId);
    });

    $(document).on('click', '#updateCandidateBtn', function () {
       let candidateId = $(this).data('id');
       updateModalInputBoxInputFields(candidateId);
    });

    $('#updateCandidateForm').on('submit', function (e) {
        e.preventDefault();
        updateCandidateInfo()
    });

    $('#topAddCandidateButton').on('click', function () {
        $('#addCandidateForm').trigger('reset');
    })

    function addCandidate() {
        $(errorMsgContainer).hide();
        $(errorMsgContainer).text('');

        var name = $('#Name').val();
        var email = $('#email').val();
        var batch = $('#batch').val();
        var post = $('#post').val();
        var formData = new FormData();
        formData.append("image", $("#candidateImage")[0].files[0]);
        formData.append("nameSend", name);
        formData.append("emailSend", email);
        formData.append("posttSend", post);
        formData.append("candidateAdd", true);
        formData.append("batchSend", batch);
        $.ajax({
            url: "candidate_backend.php",
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                let res = JSON.parse(response);
                if (res.status) {
                    displayCandidate();
                    $(errorMsgContainer).hide();
                    $(errorMsgContainer).text('');
                    $(addCandidateModal).modal('hide');
                }else {
                    $(errorMsgContainer).show();
                    $(errorMsgContainer).text(res.msg);
                }
            }
        });
    }

    function deleteCandidate(candidateId) {
        if (candidateId) {
            var proceed = confirm("Are you sure you want to delete this candidate?");
            if(proceed) {
                $.ajax({
                    type: 'post',
                    url: 'candidate_backend.php',
                    data: {
                        deleteCandidate: true,
                        candidateId: candidateId
                    },
                    success: function (response) {
                        if(response) {
                            displayCandidate();
                        }else {
                            alert('Failed to delete candidate');
                        }
                    }
                })
            }
        }else {
            alert('There is no candidate id here.');
        }
    }
    function updateModalInputBoxInputFields(candidateId) {
        if (candidateId) {
            $.ajax({
                type: 'post',
                url: 'candidate_backend.php',
                data: {
                    getCandidateInfo: true,
                    candidateId: candidateId
                },
                success: function (response) {
                    let res = JSON.parse(response);
                    console.log(res);
                    if (res.status) {
                        let data = res.data;
                        $('#updateCandidateForm input[name=candidateName]').val(data.candidatename);
                        $('#updateCandidateForm input[name=candidateEmail]').val(data.candidatemail);
                        $('#updateCandidateForm input[name=candidateBatch]').val(data.batch);
                        $(`#updateCandidateForm select[name=candidatePosts] option[value=${data.postid}]`).prop('selected', true);
                        $('#updateCandidateForm input[name=candidateid]').val(candidateId);
                        $(updateCandidateModal).modal('show');
                    }else {
                        alert('Something went wrong. Please reload the page and try again.');
                    }
                },
                error: function (error) {
                    alert('Something went wrong. Please reload the page and try again.');
                }
            })
        }
    }

    function updateCandidateInfo() {
        let candidateId = $('#updateCandidateForm input[name=candidateid]').val()
        let errorMsgContainer = $('#addCandidateForm .errorMsgContainer');
        let data = {
            candidatename : $('#updateCandidateForm input[name=candidateName]').val(),
            candidatemail : $('#updateCandidateForm input[name=candidateEmail]').val(),
            batch         : $('#updateCandidateForm input[name=candidateBatch]').val(),
            postid        : $('#updateCandidateForm select[name=candidatePosts]').val()
        }

        let formData = new FormData();
        formData.append('updateCandidate', true)
        formData.append('candidateId', candidateId)
        formData.append('candidatename', data.candidatename)
        formData.append('candidatemail', data.candidatemail)
        formData.append('batch', data.batch)
        formData.append('postid', data.postid)
        formData.append('image', $("#updateCandidateImage")[0].files[0])

        console.log(data);
        $(errorMsgContainer).text('');
        $(errorMsgContainer).hide();
        $.ajax({
            type: 'post',
            url: 'candidate_backend.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                let response = JSON.parse(res);
                console.log(response);
                if (response.status) {
                    displayCandidate();
                    resetUpdateCandidateInfoModal();
                    $(errorMsgContainer).text('');
                    $(errorMsgContainer).hide();
                    $(updateCandidateModal).modal('hide');
                }else {
                    $(errorMsgContainer).text(response.msg);
                    $(errorMsgContainer).show();
                }

            },
            error: function (error) {
                console.log(error)
            }
        })
    }

    function resetUpdateCandidateInfoModal() {
        $('#updateCandidateForm input[name=candidateName]').val('');
        $('#updateCandidateForm input[name=candidateEmail]').val('');
        $('#updateCandidateForm input[name=candidateBatch]').val('');
        $('#updateCandidateForm select[name=candidateid]').val('');
    }
});