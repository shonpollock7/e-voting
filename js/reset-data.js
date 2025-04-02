//Reset Single Vote Cast
$(document).ready(function () {
    var resetSingleVoteCastBtn = $('#resetSingleVoteCastBtn');
    var resetSingleVoteCastForm = $('#resetSingleVoteCastForm')

    $(resetSingleVoteCastBtn).on('click', function () {
        const ballotNo = $('#inputBallotNo').val()
        const voterId = $('#inputVoterId').val()
        const singleVoteCastErrMsg = $('#singleVoteCastErrMsg');

        let confirmDelete = confirm('Are you sure want to reset this single Vote Cast?');
        if (confirmDelete) {
            if (ballotNo && voterId) {
                $(singleVoteCastErrMsg).hide()
                $(resetSingleVoteCastForm).submit();
            }else {
                $(singleVoteCastErrMsg).show();
            }
        }
    });
});

$(document).ready(function () {
    //Reset all casted Vote
    var resetAllCastedVoteBtn = $('#resetAllCastedVoteBtn');
    $(resetAllCastedVoteBtn).on('click', function () {
        const confirmReset = confirm('Are you sure want to reset All Casted Vote?');
        if (confirmReset) {
            window.location.href = "/evoting/Dashboard/reset/reset_all_casted_vote.php";
        }
    });


    //Rest Candidate
    var resetCandidateBtn = $('#candidateResetBtn');
    $(resetCandidateBtn).on('click', function () {
        const confirmReset = confirm('Are you sure want to reset All Candidate Data?');
        if (confirmReset) {
            window.location.href = "/evoting/Dashboard/reset/reset_all_candidate.php";
        }
    })

    //Rest Post
    var restPostBtn = $('#resetPostBtn');
    $(restPostBtn).on('click', function () {
        const confirmReset = confirm('Are you sure want to reset All Posts Data?');
        if (confirmReset) {
            window.location.href = "/evoting/Dashboard/reset/reset_all_post.php";
        }
    });

    //rest Voter
    var resetVoterBtn = $('#resetVoterBtn');
    $(resetVoterBtn).on('click', function (){
        const confirmReset = confirm('Are you sure want to reset All Voters Data?');
        if (confirmReset) {
            window.location.href = "/evoting/Dashboard/reset/reset_all_voter.php";
        }
    })

    //Delete voter
    var deleteVoterBtn = $('#deleteVoterBtn');
    $(deleteVoterBtn).on('click', function (){
        const confirmReset = confirm('Are you sure want to delete All Voters Data?');
        if (confirmReset) {
            window.location.href = "/evoting/Dashboard/reset/delete_all_voter.php";
        }
    })

    //Reset Election
    var resetElectionBtn = $('#resetElectionBtn');
    $(resetElectionBtn).on('click', function (){
        const confirmReset = confirm('Are you sure want to reset Election Data?');
        if (confirmReset) {
            window.location.href = "/evoting/Dashboard/reset/reset_election.php";
        }
    })
});