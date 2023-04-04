import cogoToast from "cogo-toast";

const {Spinner} = wp.components;
const {useEffect, useRef} = wp.element;
import {get_parent_class_list} from "../../component-parts/functions";
import LayoutManager from "./template/LayoutManager";
import SectionTitle from "../../component-parts/SectionTitle";
import PostPagination from "../../component-parts/Pagination";

function GridLayouts({props, postData, filterMarkup}) {
    const {attributes, setAttributes, clientId} = props;
    const {
        prefix,
        uniqueId,
        filter_btn_style,
        filter_type,
        grid_layout_style,
        display_per_page,
        query_change,
        middle_border
    } = attributes;

    const posts = postData.posts;
    const totalPages = Math.ceil(postData.total_post / display_per_page);
    let dynamicParentClass = get_parent_class_list({props});
    const newClintID = clientId.substr(0, 6);

    let filterRef = useRef();

    useEffect(() => {
        if (!uniqueId) {
            setAttributes({uniqueId: newClintID});
        } else if (uniqueId && uniqueId !== newClintID) {
            setAttributes({uniqueId: newClintID});
        }

        filterRef.current.addEventListener('click', function (e) {
            if (e.target.classList.contains('rt-filter-item-wrap')) {
                cogoToast.warn('N.B: This field works front-end only.');
            }
        })
    }, []);


    let is_carousel = '';
    if (rttpgParams.hasPro && 'carousel' === filter_btn_style && 'button' === filter_type) {
        is_carousel = 'carousel';
    }

    let gridLyaoutStyle = grid_layout_style === 'masonry' ? 'tpg-even' : grid_layout_style;
    // Wrapper Class
    let innerWrapperClass = attributes[prefix + '_layout'].replace(/-2/g, "");
    innerWrapperClass += ' grid-behaviour';
    innerWrapperClass += ' ' + gridLyaoutStyle;
    innerWrapperClass += ' ' + prefix + '_layout_wrapper';
    if (['grid-layout6', 'grid-layout6-2'].includes(attributes[prefix + '_layout']) && middle_border === 'no') {
        innerWrapperClass += ' disable-middle-border';
    }

    if (query_change) {
        innerWrapperClass += ' tpg-editor-loading';
    }

    const PostMap = ({posts}) => {
        return (
            posts.map(post => {
                if (post) {
                    if (post.message) {
                        return <div className="message">{post.message}</div>
                    }
                    return <LayoutManager attributes={attributes} post={post}/>
                } else return null
            })
        )
    }


    const AllPostRender = ({posts, layout}) => {
        if (['grid-layout5', 'grid-layout5-2'].includes(layout)) {
            const offsetPost = [...posts].slice(1)
            return (
                <>
                    <div className={`rt-col-sm-6 rt-col-xs-12 offset-left-wrap offset-left`}>
                        <PostMap posts={[posts[0]]}/>
                    </div>

                    <div className={`rt-col-sm-6 rt-col-xs-12 offset-right`}>
                        <PostMap posts={offsetPost}/>
                    </div>
                </>
            )
        } else if (['grid-layout6', 'grid-layout6-2'].includes(layout)) {
            const offsetPost = [...posts].slice(1)
            return (
                <>
                    <div className={`rt-col-sm-6 rt-col-md-7 rt-col-xs-12 offset-left-wrap offset-left`}>
                        <PostMap posts={[posts[0]]}/>
                    </div>

                    <div className={`rt-col-sm-6 rt-col-md-5 rt-col-xs-12 offset-right`}>
                        <PostMap posts={offsetPost}/>
                    </div>
                </>
            )
        }
        return (
            <PostMap posts={posts}/>
        )
    }

    return (
        <div ref={filterRef} className={`rttpg-block-postgrid rttpg-block-wrapper rttpg-block-${uniqueId + ' ' + dynamicParentClass}`}>
            <div
                className={`rt-container-fluid rt-tpg-container tpg-el-main-wrapper clearfix ${attributes[prefix + '_layout']}-main`}
                data-el-settings='' data-el-query='' data-el-path=''>
                {(posts && posts.length) &&
                    <div className={`tpg-header-wrapper ${is_carousel}`}>
                        <SectionTitle attributes={attributes} setAttributes={setAttributes}/>
                        {rttpgParams.hasPro && <div className={`rt-layout-filter-container rt-clear`}
                                                    dangerouslySetInnerHTML={{__html: filterMarkup}}></div>}
                    </div>
                }
                <div className={`rt-row rt-content-loader ${innerWrapperClass}`}>
                    {
                        (posts && posts.length) ?
                            <AllPostRender posts={posts} layout={attributes[prefix + '_layout']}/>
                            :
                            <div className="rttpg-postgrid-is-loading">
                                {(postData?.message && postData.message) ? postData.message : <Spinner/>}
                            </div>
                    }
                </div>
                <PostPagination props={props} totalPages={totalPages}/>
            </div>
        </div>
    )
}

export default GridLayouts;