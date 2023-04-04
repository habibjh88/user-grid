import Thumbnail from "../../../../../../the-post-grid/src/blocks/component-parts/Thumbnail"
import Heading from "../../../../../../the-post-grid/src/blocks/component-parts/Heading"
import MetaData from "../../../../../../the-post-grid/src/blocks/component-parts/MetaData";
import SocialShare from "../../../../../../the-post-grid/src/blocks/component-parts/SocialShare";
import ReadMore from "../../../../../../the-post-grid/src/blocks/component-parts/ReadMore";
import PostExcerpt from "../../../../../../the-post-grid/src/blocks/component-parts/PostExcerpt";

function Layout1( { attributes, post } ) {
    const {
              grid_column,
              hover_animation,
              show_thumb,
              show_title,
              show_meta,
              show_excerpt,
              show_acf,
              show_social_share,
              show_read_more
          } = attributes;

    let colClasses = " rt-slider-item swiper-slide rt-grid-item";
    colClasses += " " + hover_animation;

    return (
        <div className={ post.post_class + ' ' + colClasses } data-id={ post.id }>

            <div className="rt-holder tpg-post-holder">
                <div className="rt-detail rt-el-content-wrapper">

                    { (show_thumb === 'show') &&
                        <Thumbnail attributes={ attributes } post={ post }/>
                    }

                    { show_title === 'show' &&
                        <Heading attributes={ attributes } post={ post }/>
                    }

                    { show_meta === 'show' &&
                        <MetaData attributes={ attributes } post={ post }/>
                    }

                    { (show_excerpt === 'show' || show_acf === 'show') &&
                        <PostExcerpt attributes={ attributes } post={ post }/>
                    }

                    { (rttpgParams.hasPro && show_social_share === 'show') &&
                        <SocialShare/>
                    }

                    { show_read_more === 'show' &&
                        <ReadMore attributes={ attributes }/>
                    }
                </div>

            </div>

        </div>
    );
}

export default Layout1;
