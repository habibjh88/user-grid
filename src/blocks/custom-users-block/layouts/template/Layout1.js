function Layout1({attributes, user}) {

    const {
        grid_column,
        name_tag,
        avatar_visibility,
        name_visibility,
        bio_visibility,
        social_visibility
    } = attributes;

    //Grid Column settings
    let default_grid_column_desktop = '3';
    let default_grid_column_tab = '4';
    let default_grid_column_mobile = '6';

    let grid_column_desktop = grid_column?.lg ? grid_column.lg : default_grid_column_desktop;
    let grid_column_tab = grid_column?.md ? grid_column.md : default_grid_column_tab;
    let grid_column_mobile = grid_column?.sm ? grid_column.sm : default_grid_column_mobile;

    const user_column = `cub-col-md-${grid_column_desktop} cub-col-sm-${grid_column_tab} cub-col-xs-${grid_column_mobile}`;
    const HeadingTag = `${name_tag}`;

    return (
        <div key={user.id} className={`user-item-col ${user_column}`}>
            {user.avatar && avatar_visibility &&
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
            {name_visibility &&
                <HeadingTag className="user-name">
                    <a>{user.name}</a>
                </HeadingTag>
            }
            {bio_visibility && <p className="user-biography">{user.biography}</p>}

            {social_visibility === 'show' &&
                <div className="social-icons">
                    {user.social.facebook &&
                        <a href={user.social.facebook}><i
                            className="dashicons dashicons-facebook-alt"></i></a>
                    }
                    {user.social.twitter &&
                        <a href={user.social.twitter}><i
                            className="dashicons dashicons-twitter"></i></a>
                    }

                    {user.social.linkedin &&
                        <a href={user.social.linkedin}><i
                            className="dashicons dashicons-linkedin"></i></a>
                    }
                    {user.social.gplus &&
                        <a href={user.social.gplus}><i
                            className="dashicons dashicons-google"></i></a>
                    }
                    {user.social.pinterest &&
                        <a href={user.social.pinterest}><i
                            className="dashicons dashicons-pinterest"></i></a>
                    }


                </div>
            }
        </div>
    );
}

export default Layout1;
