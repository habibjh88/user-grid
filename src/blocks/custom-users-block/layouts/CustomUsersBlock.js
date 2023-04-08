const {Spinner} = wp.components;
const {useEffect} = wp.element;
import Layout1 from "./template/Layout1";

function CustomUsersBlock({props, userData}) {
    const {attributes, setAttributes, clientId} = props;
    const {
        uniqueId,
        image_link,
        grid_style
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
    wrapper_classes += grid_style;

    return (
        <div className={`gtusers-block-postgrid gtusers-block-wrapper gtusers-block-${uniqueId} ${wrapper_classes}`}>
            {userData.users && userData.users.length ?
                <div className="cub-users-block-wrapper clearfix">
                    <div className="cub-row">
                        {
                            userData.users.map(user => {
                                return (
                                    <Layout1 attributes={attributes} user={user}/>
                                )
                            })
                        }
                    </div>
                </div>
                :
                <div className="gtusers-postgrid-is-loading">
                    {userData.message  ? <div className={`not-found-wrap`}>{userData.message}</div> : <Spinner/>}
                </div>
            }
        </div>
    )
}

export default CustomUsersBlock;