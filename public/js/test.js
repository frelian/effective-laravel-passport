/*
    Opcion 1:
    let token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiN2IyYjZlMDJjNjBiMjFkMzQ5YjQ1MWUyMzA4MzEwMzY1M2Y2MDU1ZjBmN2JkODdhODRlOTlmNTE4NGI1ODNlNGFiMTEzMTZiNjU0YzMzMWEiLCJpYXQiOiIxNjEwMjk3MjEzLjY1Mzg4MSIsIm5iZiI6IjE2MTAyOTcyMTMuNjUzODg0IiwiZXhwIjoiMTY0MTgzMzIxMy42NTE3MzQiLCJzdWIiOiIxMCIsInNjb3BlcyI6W119.NaLvrLzCYfqDi5r5r8slYscq5kI0WpsB3G-LJiMuQXGsoEFH_fMHeUthSnI4hPeGkGibqP5VtBXEfjb-YIfjzvvUTccbbDBRioPTXJXOtyNcLGQqHQHJ-dfcnp796fanOw1wM2YfP9UBsX5sqwf2uxEXYWk6v1ByDPRgre74WkdLIk_RTTPZfqCgbl50YYE__3zyaHpmY_aFX7HgYYLwTAeNnM3Q7gAySv0POZr4l9BFqkOFMRDoF_8QqogDVZdX8ZJfoi9uq5LrRsd_cv_D5cS3q2PZRLmqV0-p4sWyny-MMm8OkbyCdiln53jsVb5WFq-FVDM9aq0MPL1PlQIH7dD4bw0VOM6TSkGqn9inJvzRKGR_kfYdhLug30qoXX2-gFETwVTTs8vgi9UavNk8-vOBlkPsdpvITBW6KKJLjqfpEZR_Yn1d7RJH8PLoUCqe3xUL2E10EF89H3USApbI9OCZY9OBouaLisUeG2wzNsu0NwBe-8bKS48eP3SYBNQz3SVhXZvGDF5zrMEdu7-QZlMNnUl8yH2d5Uk-tXCXulbVZyyxhSrZN_eN0gnmzdQ00Ybm7fuGZhRxxgQPAnNoalYJa3735kYE1J4qEIBo80WNT6pi5EXil5k1yJnyh6O1oTTBmqjRUpLkHARKe5BPDcF0ZhSdh-cA7wyGTqrdaN8";

    fetch('http://127.0.0.1:8000/api/profile', {
        method: "POST",
        headers: {
            "Content-type": "application/json;charset=UTF-8",
            "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiN2IyYjZlMDJjNjBiMjFkMzQ5YjQ1MWUyMzA4MzEwMzY1M2Y2MDU1ZjBmN2JkODdhODRlOTlmNTE4NGI1ODNlNGFiMTEzMTZiNjU0YzMzMWEiLCJpYXQiOiIxNjEwMjk3MjEzLjY1Mzg4MSIsIm5iZiI6IjE2MTAyOTcyMTMuNjUzODg0IiwiZXhwIjoiMTY0MTgzMzIxMy42NTE3MzQiLCJzdWIiOiIxMCIsInNjb3BlcyI6W119.NaLvrLzCYfqDi5r5r8slYscq5kI0WpsB3G-LJiMuQXGsoEFH_fMHeUthSnI4hPeGkGibqP5VtBXEfjb-YIfjzvvUTccbbDBRioPTXJXOtyNcLGQqHQHJ-dfcnp796fanOw1wM2YfP9UBsX5sqwf2uxEXYWk6v1ByDPRgre74WkdLIk_RTTPZfqCgbl50YYE__3zyaHpmY_aFX7HgYYLwTAeNnM3Q7gAySv0POZr4l9BFqkOFMRDoF_8QqogDVZdX8ZJfoi9uq5LrRsd_cv_D5cS3q2PZRLmqV0-p4sWyny-MMm8OkbyCdiln53jsVb5WFq-FVDM9aq0MPL1PlQIH7dD4bw0VOM6TSkGqn9inJvzRKGR_kfYdhLug30qoXX2-gFETwVTTs8vgi9UavNk8-vOBlkPsdpvITBW6KKJLjqfpEZR_Yn1d7RJH8PLoUCqe3xUL2E10EF89H3USApbI9OCZY9OBouaLisUeG2wzNsu0NwBe-8bKS48eP3SYBNQz3SVhXZvGDF5zrMEdu7-QZlMNnUl8yH2d5Uk-tXCXulbVZyyxhSrZN_eN0gnmzdQ00Ybm7fuGZhRxxgQPAnNoalYJa3735kYE1J4qEIBo80WNT6pi5EXil5k1yJnyh6O1oTTBmqjRUpLkHARKe5BPDcF0ZhSdh-cA7wyGTqrdaN8",
        }
    })
    .then(response => response.json())
    .then(json => console.log(json))
    .catch(err => console.log(err));
*/

var url = window.location.search;
url = url.replace("?", ''); // remove the ?

const tokenParam = new URLSearchParams(window.location.search);
const tokenUser = tokenParam.get('token');
// var token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiN2IyYjZlMDJjNjBiMjFkMzQ5YjQ1MWUyMzA4MzEwMzY1M2Y2MDU1ZjBmN2JkODdhODRlOTlmNTE4NGI1ODNlNGFiMTEzMTZiNjU0YzMzMWEiLCJpYXQiOiIxNjEwMjk3MjEzLjY1Mzg4MSIsIm5iZiI6IjE2MTAyOTcyMTMuNjUzODg0IiwiZXhwIjoiMTY0MTgzMzIxMy42NTE3MzQiLCJzdWIiOiIxMCIsInNjb3BlcyI6W119.NaLvrLzCYfqDi5r5r8slYscq5kI0WpsB3G-LJiMuQXGsoEFH_fMHeUthSnI4hPeGkGibqP5VtBXEfjb-YIfjzvvUTccbbDBRioPTXJXOtyNcLGQqHQHJ-dfcnp796fanOw1wM2YfP9UBsX5sqwf2uxEXYWk6v1ByDPRgre74WkdLIk_RTTPZfqCgbl50YYE__3zyaHpmY_aFX7HgYYLwTAeNnM3Q7gAySv0POZr4l9BFqkOFMRDoF_8QqogDVZdX8ZJfoi9uq5LrRsd_cv_D5cS3q2PZRLmqV0-p4sWyny-MMm8OkbyCdiln53jsVb5WFq-FVDM9aq0MPL1PlQIH7dD4bw0VOM6TSkGqn9inJvzRKGR_kfYdhLug30qoXX2-gFETwVTTs8vgi9UavNk8-vOBlkPsdpvITBW6KKJLjqfpEZR_Yn1d7RJH8PLoUCqe3xUL2E10EF89H3USApbI9OCZY9OBouaLisUeG2wzNsu0NwBe-8bKS48eP3SYBNQz3SVhXZvGDF5zrMEdu7-QZlMNnUl8yH2d5Uk-tXCXulbVZyyxhSrZN_eN0gnmzdQ00Ybm7fuGZhRxxgQPAnNoalYJa3735kYE1J4qEIBo80WNT6pi5EXil5k1yJnyh6O1oTTBmqjRUpLkHARKe5BPDcF0ZhSdh-cA7wyGTqrdaN8";

/*
// Ejemplo implementando el metodo POST:
async function postData(url = '', data = {}) {
    if (tokenUser != '') {
        // Opciones por defecto estan marcadas con un *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + tokenUser,
                // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }
}

postData('http://127.0.0.1:8000/api/profile', { answer: 42 })
    .then(function(response) {

        // if (response.isLogued === true) {
        if (response.message === undefined) {
            console.log("Bienvenido...");
            console.log(response);

            if ( response.user.role != 'admin' ) {
                document.location.replace('/FALTA_DEFINIR_VISTA');
            }
        } else {
            document.location.replace('/login');
            // console.log("error");
        }

        // console.log(response)
        // console.log(response.message)
    });




*/
