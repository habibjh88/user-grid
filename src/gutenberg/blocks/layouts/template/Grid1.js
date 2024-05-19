import {dynamicCols} from '../../../../utils/Utility'
function Grid1({attributes, user}) {

    const {
        grid_column,
        name_tag,
        content_order,
        avatar_visibility,
        designation_visibility,
        name_visibility,
        email_visibility,
        bio_visibility,
        social_visibility,
        short_desc_visibility
    } = attributes;



    const user_column = dynamicCols(grid_column)

    const HeadingTag = `${name_tag}`;
    function order_class(item){
        const index = content_order.indexOf(item)
        return `order-${index}`
    }

    console.log(user.markup)

    return (
        <div dangerouslySetInnerHTML={{__html:user.markup}}></div>
    );
}

export default Grid1;
