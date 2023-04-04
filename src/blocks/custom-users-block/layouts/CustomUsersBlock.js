const {Spinner} = wp.components;
const {useEffect} = wp.element;

function CustomUsersBlock({props, userData, changeQuery}) {
    const {attributes, setAttributes, clientId} = props;
    const {
        uniqueId,
        grid_column,
        user_tag,
    } = attributes;

    const newClintID = clientId.substr(0, 6);
    const users = userData.users;

    useEffect(() => {
        if (!uniqueId) {
            setAttributes({uniqueId: newClintID});
        } else if (uniqueId && uniqueId !== newClintID) {
            setAttributes({uniqueId: newClintID});
        }
    }, []);


    //Slider Column settings
    let default_grid_column_desktop = '24';
    let default_grid_column_tab = '4';
    let default_grid_column_mobile = '6';

    let grid_column_desktop = grid_column?.lg ? grid_column.lg : default_grid_column_desktop;
    let grid_column_tab = grid_column?.md ? grid_column.md : default_grid_column_tab;
    let grid_column_mobile = grid_column?.sm ? grid_column.sm : default_grid_column_mobile;

    const cat_column = `rt-col-md-${grid_column_desktop} rt-col-sm-${grid_column_tab} rt-col-xs-${grid_column_mobile}`;

    // const CategoryTag = `${cat_tag}`;
    const HeadingTag = `${user_tag}`;

    console.log(users)
    return (


        <div className={`rttpg-block-postgrid rttpg-block-wrapper rttpg-block-${uniqueId}`}>

            {users && users.length ?
                <div className="csb-users-block-wrapper clearfix">
                    <div className="rt-row">

                        {
                            users.map(user => {
                                return (
                                    <div key={user.id} className={`cat-item-col ${cat_column}`}>
                                        {user.avatar &&
                                            <div className="user-avatar">
                                                <a className="user-link">
                                                    <img src={user.avatar}
                                                         className="user-image"
                                                         alt={user.name}
                                                         decoding="async"
                                                         loading="lazy"/>
                                                </a>
                                            </div>
                                        }
                                        <HeadingTag className="user-name">
                                            <a>{user.name}</a>
                                        </HeadingTag>
                                        <p className={`user-biography`}>{user.biography}</p>
                                    </div>
                                )
                            })
                        }


                    </div>
                </div>
                :
                <div className="rttpg-postgrid-is-loading">
                    {(users?.message && users.message) ? users.message : <Spinner/>}
                </div>
            }

        </div>


    )
}

export default CustomUsersBlock;