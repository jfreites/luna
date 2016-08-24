<?php

echo get_ol($pages);

function get_ol ($array, $child = FALSE)
{
    $str = '';

    if (count($array)) {
        $str .= $child == FALSE ? '<ol class="sortable ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded">' : '<ol>';

        foreach ($array as $item) {
            $str .= '<li style="display: list-item;" class="mjs-nestedSortable-branch mjs-nestedSortable-expanded" id="list_' . $item['id'] .'">';
            //$str .= '<div class="menuDiv"><span class="glyphicon glyphicon-edit editItem" data-id="'.$item['id'].'"></span><p>' . $item['title'] .'</p></div>';

            $str .= '<div class="menuDiv">
			   <span>
			   <span data-id="2" class="itemTitle">'.$item['title'].'</span>
			   <span title="Click to edit item." data-id="'.$item['id'].'" class="editItem ui-icon ui-icon-pencil">
			   <span></span>
			   </span>
			   </span>
			   <div id="menuEdit_'.$item['id'].'" class="menuEdit hidden">
				   <p>
					   Content or form, or nothing here. Whatever you want.
				   </p>
			   </div>
		   </div>';

            // Do we have any children?
            if (isset($item['children']) && count($item['children'])) {
                $str .= get_ol($item['children'], TRUE);
            }

            $str .= '</li>' . PHP_EOL;
        }

        $str .= '</ol>' . PHP_EOL;
    }

    return $str;
}
?>

<script>
    $(document).ready(function(){

        $('ol.sortable').nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div',
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            maxLevels: 3,
            isTree: true,
            change: function(){
                console.log('Relocated item');
            }
        });

    });
</script>