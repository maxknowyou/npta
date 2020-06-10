$(".Sort").on("click", function() {
    var reA = /[^a-zA-Z]/g;
    var reN = /[^0-9]/g;
    var data = $(this).attr("data-classsort");
    var type = $(this).attr("data-typesort");
    if (type == "des")
        $(this).attr("data-typesort", "asc");
    else
        $(this).attr("data-typesort", "des");
    let count = $("#SortUl li:not(:first-child)").first().find(".item-span-order").text();
    $("#SortUl li:not(:first-child)").sort(sort_li).appendTo('#SortUl');
    $.each($("#SortUl li:not(:first-child)"), function() {
        $(this).find(".item-span-order").text(count++);
    })

    function sort_li(a, b) 
    {
    var aA = $(a).find(data).text().toLowerCase().replace(reA, "");
    var bA = $(b).find(data).text().toLowerCase().replace(reA, "");
    if(type == "des")
    {
        if (aA === bA) {
        var aN = parseInt($(a).find(data).text().toLowerCase().replace(reN, ""), 10);
        var bN = parseInt($(b).find(data).text().toLowerCase().replace(reN, ""), 10);
        return aN === bN ? 0 : aN > bN ? 1 : -1;
        } else {
            return aA > bA ? 1 : -1;
        }
    }
    else
    {
        if (aA === bA) {
        var aN = parseInt($(a).find(data).text().toLowerCase().replace(reN, ""), 10);
        var bN = parseInt($(b).find(data).text().toLowerCase().replace(reN, ""), 10);
        return aN === bN ? 0 : aN < bN ? 1 : -1;
        } else {
            return aA < bA ? 1 : -1;
        }
    }
    
}
})
$('#Search').keyup(function(){
    var that = this, $allListElements = $('#SortUl li:not(:first-child)');
    var $matchingListElements = $allListElements.filter(function(i, li){
        var listItemText = $(li).text().toUpperCase(), searchText = that.value.toUpperCase();
        return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
});
$(function(){
    var current = location.pathname;
    console.log(current);
    let pos = 0;
    for(let i = 1;i<current.length;i++)
    {
        if(current[i].match("/"))
        {
            console.log(i);
            pos = i;
            break;
        }
    }
    if(pos!= 0)
    {
        current = current.substring(0, pos);
    }
    if(current == "/")
        {
            current += "home";
            $('#sidebar-menu li:first').addClass('active open');
        }
        else
        {
            $('#sidebar-menu li a').each(function(){
                var $this = $(this);
                console.log($this.text());
                if($this.attr('href').indexOf(current) !== -1){
                    console.log($this);
                    $this.parent().addClass('active open');
                    $this.parent().parent().parent().addClass('active open');
                    $this.parent().parent().parent().find("a").attr("aria-expanded",true);
                    $this.parent().parent().addClass("in");
                }
                // if the current path is like this link, make it active
                
            })
        }
   
})