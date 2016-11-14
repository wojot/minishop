<script>
    var produkty = [];

</script>
<button onclick="dodajDoKoszyka('4')">Click me</button><br>
<div id="result"></div>

<script>

    document.getElementById("result").innerHTML = produkty[0];

    function dodajDoKoszyka(x){
        produkty.push(x);
    }

    // Check browser support
//    if (typeof(Storage) !== "undefined") {
//        // Store
//        localStorage.setItem("lastname", "Smith");
//        // Retrieve
//        document.getElementById("result").innerHTML = localStorage.getItem("lastname");
//    } else {
//        document.getElementById("result").innerHTML = "Sorry, your browser does not support Web Storage...";
//    }
</script>




Mamy ikonę koszyka gdzieś w rogu a obok liczbę z aktualną ilością produktów:

<div> Koszyk <span id="bucketCount"></span></div>

<script>
    $(document).ready( // czekam na załadowanie strony
        function() {
            var retrievedBucket = localStorage.getItem('bucketArray'); // pobieram z localstorage koszyk
            if (retrievedBucket == null) retrievedBucket = 0; // jeżeli nic nie ma w localstorage to ustawiamy na 0
            $('#bucketCount').text(' ('+retrievedBucket+') '); // wpisuje jego wartość w element o id bucketCount
        }
    );
</script>


<!--// ------------------------------------------------------------------------------------------------------------------>
<!---->
<!--Jak tworzysz sobie foreach'em listę produktów to dodawaj sobie przycisk "Dodaj do koszyka", gdzie-->
<!--twórz sobie atrybut data-id i zapisuj tam ID produktu, np:-->

<div class="addTobucket" data-id="1212">Dodaj do koszyka</div>


<!--Teraz zrób event który w momencie kliknięcia na przycisk, doda nam to id produktu do localstorage-->
<!--i przekieruje do koszyka albo odświeży stronę, czyli:-->

<script>

$( ".addTobucket" ).on( "click", function() { // podczas kliknięcia na element z klasą addTobucket
var productId = $(this).attr("data-id"); // pobranie ID z atrybutu data-id dla klikniętego elementu

var bucketArray = JSON.parse(localStorage.getItem('bucketArray')); // pobranie aktualnej wartości dla localstorage, zamienioną z string na json
if (!bucketArray) var bucketArray = []; // jeżeli nie ma nic w localstorage tworzymy nową array'kę

bucketArray.push({id : productId}); // dodajemy id klikniętego produktu do naszej tablicy

localStorage.setItem('bucketArray', JSON.stringify(bucketArray)); // zapisujemy tablicę do localstorage, zamienioną na string bo w localstorage można mieć tylko string

location.reload(); // odświeżenie strony
});

</script>
// ----------------------------------------------------------------------------------------------------------------

teraz musisz sobie zrobić stronę "koszyka" i wylistować to wszystko dodająć input dla ilości