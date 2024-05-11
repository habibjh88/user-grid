const {Spinner} = wp.components;
const {useEffect} = wp.element;
import Grid1 from "./template/Grid1";
import List1 from "./template/List1";

function CustomUsersBlock({props, userData}) {
    const {attributes, setAttributes, clientId} = props;
    const {
        layout,
        uniqueId,
        image_link,
        grid_style,
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
    wrapper_classes += ' dowp' + layout;
    wrapper_classes += grid_style;

    return (
        <div className={`dowp-block-postgrid dowp-block-wrapper dowp-block-${uniqueId} ${wrapper_classes}`}>
            {userData.users && userData.users.length ?
                <div className="cub-users-block-wrapper clearfix">
                    <div className="cub-row">
                        {
                            userData.users.map(user => {
                                if('grid-1' === layout) {
                                    return (<Grid1 attributes={attributes} user={user}/>)
                                } else if('list-1' === layout){
                                    return (<List1 attributes={attributes} user={user}/>)
                                }
                            })
                        }
                    </div>
                </div>
                :
                <div className="dowp-postgrid-is-loading">
                    {userData.message ? <div className={`not-found-wrap`}>{userData.message}</div> : <Spinner/>}
                </div>
            }
        </div>
    )
}

export default CustomUsersBlock;