import Thumbnail2 from "../../../../../../the-post-grid/src/blocks/component-parts/Thumbnail2";

function SliderThumb({post, attributes}) {

    const {title, category, post_date} = post;

    const catCount = category.length;

    return (
        <div className="swiper-slide">
            <div className="post-thumbnail-wrap">
                <div className="p-thumbnail">
                    <Thumbnail2 size='1' attributes={attributes} post={post}/>
                </div>
                <div className="p-content">
                    <div className="post-taxonomy">
                       <span className="categories-links">
                           {category.map((cat, index) => (
                               <>
                                   <a href="#">{cat}</a>
                                   {index !== (catCount - 1) && <span className="rt-separator">,</span>}
                               </>
                           ))}
                        </span>
                    </div>
                    <h3 className="thumb-title">{title}</h3>
                    <span className="thumb-date">{post_date}</span>
                </div>
            </div>
        </div>
    );
}

export default SliderThumb;
