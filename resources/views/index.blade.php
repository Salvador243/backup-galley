@extends('layouts.app')
@section('content')
<!-- Main container -->
<div class="container">
    <!-- Results contents -->
    <div class="" id="results">

    </div>
    <!-- Pagination results -->
    <div id="pagination_controls" class="mt-4 d-flex justify-content-center">
        <button id="btn_prev" class="btn btn-danger mr-2" disabled>Anterior</button>
        <button id="btn_next" class="btn btn-danger" disabled>Siguiente</button>
    </div>
</div>

<script>
    // When the document is ready
    $(document).ready(function () {
        // Change the search form destination url
        $("#search-form").attr('action', '/search');
        // Define the Ajax request for the search form
        $("#search-form").submit(function (ev) {
            $.ajax({
                type: $('#search-form').attr('method'),
                url: $('#search-form').attr('action'),
                data: $('#search-form').serialize(),
                success: function (json) {
                    //Decode de JSON
                    var decode = JSON.parse(json);
                    // Set the images in the results container
                    setImages(decode);
                    // Update the pagination controls
                    configControls(decode);
                }
            });
            // Deny redirection
            ev.preventDefault();
        });

        // Load the results for the first time
        $("#search-form").submit();

        /*
         * Auxiliar functions definition
         */
        //Return an array with the variables in the current url
        function getQueryVariable(variable) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");

            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");

                if (pair[0] == variable)
                    return pair[1];
            }

            return false;
        }

        // Set images in the results container
        function setImages(decode) {
            var results = decode[0].data;
            var type = decode[1];
            var str = '';

            //If there's no results
            if (!results.length) {
                str = `<h2 class="text-center text-muted mt-5">No hay resultados para mostrar</h2>`;
                return;
            }

            //If the results type is 'picture'
            if (type) {
                // Change container's alignment to 'card columns'
                $("#results").attr("class", "card-columns");

                for (let picture of results) {
                    str += `
                        <div class="card">
                            <a href="/picture_details/${picture.id}">
                                <img class="card-img-top" src="${picture.image}">
                            </a>
                        </div>
                    `;
                }
            //If the results type is profile
            } else {
                // Change container's alignment to 'row'
                $("#results").attr("class", "row");

                for (let profile of results) {
                    str += `
                        <div class="col-12 col-lg-5 card shadow profile-card m-2">
                            <div class="row row-cols-3">
                                <!--Avatar-->
                                <div class="col d-flex justify-content-center m-0 p-0">
                                    <img width="70px" height="70px" class="avatar align-self-center rounded-profile my-1" src="${profile.avatar}">
                                </div>
                                <!--Information-->
                                <div class="col card-body p-1 align-self-center">
                                    <h5 class="card-title mt-3">${profile.name}</h5>
                                    <a href="/profiles/${profile.id}" class="btn btn-danger mt-1">Ver perf&iacute;l</a>
                                </div>
                            </div>
                        </div>
                    `;
                }
            }

            //Set the results into the container
            $("#results").html(str);
        }

        // Control the availability of buttons depending the results pages
        function enableControls(decode) {
            // Previous button verification
            if (decode[0].prev_page_url)
                $("#btn_prev").removeAttr('disabled');
            else 
                $("#btn_prev").attr('disabled', 'true');

            // Next button verification
            if (decode[0].next_page_url)
                $("#btn_next").removeAttr('disabled');
            else
                $("#btn_next").attr('disabled', 'true');
        }

        // Define the request for each pagination button
        function configControls(decode) {
            enableControls(decode);

            // Previous button definition
            if (!$("#btn_prev").attr('disabled')) {
                $("#btn_prev").click(function () {
                    $.ajax({
                        type: 'GET',
                        url: decode[0].prev_page_url,
                        dataType: 'json',
                        success: function (arr) {
                            setImages(arr);
                            configControls(arr);
                        }
                    });
                });
            }

            // Next button definition
            if (!$("#btn_next").attr('disabled')) {
                $("#btn_next").click(function () {
                    $.ajax({
                        type: 'GET',
                        url: decode[0].next_page_url,
                        dataType: 'json',
                        success: function (arr) {
                            setImages(arr);
                            configControls(arr);
                        }
                    });
                });
            }
        }

        // Remember the state of search parameters
        if (getQueryVariable('radioSearch')) {
            $("#search_input").val(getQueryVariable('search'));
            if ($("input[name='radioSearch']:checked").val() != getQueryVariable('radioSearch')) {
                $("#radio_pictures").prop("checked", false);
                $("#radio_profiles").prop("checked", true);
            }
        }
    });
</script>
@endsection
