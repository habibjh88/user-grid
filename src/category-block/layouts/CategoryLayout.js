const {Spinner} = wp.components;
const {useEffect} = wp.element;

function CategoryLayout({props, catData, changeQuery}) {
    const {attributes, setAttributes, clientId} = props;
    const {
        uniqueId,
        grid_column,
        cat_tag,
        count_position,
        count_visibility,
        show_bracket
    } = attributes;

    const categories = catData.categories;
    const newClintID = clientId.substr(0, 6);

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
    const HeadingTag = `${cat_tag}`;
    return (


        <div className={`rttpg-block-postgrid rttpg-block-wrapper rttpg-block-${uniqueId}`}>

            {categories && categories.length ?
                <div className="tpg-category-block-wrapper clearfix">
                    <div className="rt-row">

                        {
                            categories.map(category => {
                                return (
                                    <div key={category.cat_id} className={`cat-item-col ${cat_column}`}>
                                        <div className="cat-thumb">
                                            <a className="cat-link">
                                                <img src={category.image}
                                                     className="category-image"
                                                     alt=""
                                                     decoding="async"
                                                     loading="lazy"/>
                                            </a>
                                            {count_visibility && count_position === 'thumb' &&
                                                <span className="count count-thumb">
                                                    {show_bracket ? "(" : ""}
                                                    {category.count}
                                                    {show_bracket ? ")" : ""}
                                                </span>
                                            }
                                        </div>
                                        <HeadingTag className="category-name">
                                            <a>{category.name} {` `}</a>
                                            {count_visibility && count_position === 'title' &&
                                                <span className="count count-title">
                                                    {show_bracket ? "(" : ""}
                                                    {category.count}
                                                    {show_bracket ? ")" : ""}
                                                </span>
                                            }
                                        </HeadingTag>
                                    </div>
                                )
                            })
                        }


                    </div>
                </div>
                :
                <div className="rttpg-postgrid-is-loading">
                    {(categories?.message && categories.message) ? categories.message : <Spinner/>}
                </div>
            }

        </div>


    )
}

export default CategoryLayout;