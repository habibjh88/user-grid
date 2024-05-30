const {Spinner} = wp.components;
const {useEffect} = wp.element;

function CustomUsersBlock({props, userData}) {
    const {attributes, setAttributes, clientId} = props;
    const {
        uniqueId,
        image_link,
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

    return (
        userData.markup ?
            <div className={`dowp-block-usergrid ${wrapper_classes}`}>
                <div className="dowp-editor-markup" dangerouslySetInnerHTML={{__html:userData.markup}}></div>
            </div>
            :
            <div className="dowp-usergrid-is-loading">
                {userData.message ? <div className={`not-found-wrap`}>{userData.message}</div> : <Spinner/>}
            </div>

    )
}
export default CustomUsersBlock;