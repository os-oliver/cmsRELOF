DROP PROCEDURE IF EXISTS paginate_documents;
DELIMITER $$

CREATE PROCEDURE paginate_documents(
    IN p_limit INT,
    IN p_offset INT,
    IN p_lang VARCHAR(10)
)
BEGIN
    -- Glavni SELECT sa LIMIT pre join-a
    SELECT 
        d.id,
        d.category_id,
        d.filepath,
        d.extension,
        d.datetime,
        d.fileSize,
        te.field_name, 
        te.content, 
        tc.content AS name, 
        k.color_code
    FROM (
        SELECT id
        FROM document
        ORDER BY datetime DESC
        LIMIT p_offset, p_limit
    ) AS page_docs
    JOIN document d ON d.id = page_docs.id
    JOIN text te 
        ON te.source_id = d.id
       AND te.source_table = 'document'
       AND te.lang = p_lang COLLATE utf8mb4_unicode_ci
    JOIN category_document k ON k.id = d.category_id
    JOIN text tc 
        ON tc.source_id = k.id
       AND tc.source_table = 'category_document'
       AND tc.lang = p_lang COLLATE utf8mb4_unicode_ci
    ORDER BY d.datetime DESC;

    -- Ukupan broj redova
    SELECT FOUND_ROWS() AS total;
END$$

DELIMITER ;
