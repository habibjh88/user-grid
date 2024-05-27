const {Spinner} = wp.components;
const {useEffect} = wp.element;
import {extendClass, layoutAlign} from "../../utils/Utility";

function CustomUsersBlock({props, userData}) {
    const {attributes, setAttributes, clientId} = props;
    const {
        layout,
        uniqueId,
        image_link,
        grid_alignment
    } = attributes;

    const newClintID = clientId.substr(0, 6);

    useEffect(() => {
        if (!uniqueId) {
            setAttributes({uniqueId: newClintID});
        } else if (uniqueId && uniqueId !== newClintID) {
            setAttributes({uniqueId: newClintID});
        }
    }, []);


    let wrapper_classes = image_link ? '' : ' no-image-link';
    wrapper_classes += `dowp-block-${uniqueId}`;

    let inner_classes = layout.replace(/[0-9]/g, '') + '-style';
    inner_classes += extendClass(layout);
    inner_classes += ' dowp-' + layout;
    inner_classes += ' ' + layoutAlign(grid_alignment);

    return (
        <div className={`dowp-block-usergrid dowp-block-wrapper ${wrapper_classes}`}>
            {userData.markup ?
                <div className={`dwp-users-block-wrapper clearfix ${inner_classes}`}>
                    <div className="dwp-row" dangerouslySetInnerHTML={{__html:userData.markup}}></div>
                </div>
                :
                <div className="dowp-usergrid-is-loading">
                    {userData.message ? <div className={`not-found-wrap`}>{userData.message}</div> : <Spinner/>}
                </div>
            }
        </div>
    )
}
export default CustomUsersBlock;